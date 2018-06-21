<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $frequency
 * @property int $status
 * @property int $author_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $author
 */
class Category extends ActiveRecord
{
    //statusy
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @param bool $insert
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date("Y-m-d H:i:s"),
            ],
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['author_id', 'status', 'frequency'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'status' => 'Status',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return string[]
     */
    public static function getStatusNames()
    {
        return [
            static::STATUS_ACTIVE => 'Aktywny',
            static::STATUS_INACTIVE => 'Nieaktywny',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return User::getStatusNames()[$this->status];
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            static::STATUS_ACTIVE,
            static::STATUS_INACTIVE,
        ];
    }

    public static function saveCategory($array, $itemID)
    {
        $array = array_unique($array);

        foreach ($array as $id) {
            ItemCategory::connect($itemID, $id);
        }
    }

    public function frequencyIncrement()
    {
        $this->frequency = $this->frequency + 1;
        $this->save(false, ['frequency']);
    }

    public function frequencyDecrement()
    {
        if ($this->frequency <= 0) {
            $this->frequency = 0;
        } else {
            $this->frequency = $this->frequency - 1;
        }

        $this->save(false, ['frequency']);
    }

    public static function getShowCastCategory()
    {
        $connection = Yii::$app->getDb();

        $sql = "SELECT COUNT(*) AS count, category.slug, category.name
                FROM item
                LEFT JOIN item_category ON item.id = item_category.item_id
                JOIN category ON category.id = item_category.category_id
                WHERE category.status = :status
                GROUP BY item.id
                ORDER BY count ASC";

        $command = $connection->createCommand($sql, ['status' => Category::STATUS_ACTIVE]);
        $result = $command->queryAll();

        return $result;
    }
}
