<?php

namespace app\models;

use app\components\Inflector;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property int $id
 * @property string $name
 * @property int $frequency
 * @property int $status
 * @property int $author_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $author
 */
class Tag extends ActiveRecord
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['frequency', 'status', 'author_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'frequency' => 'Frequency',
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

    /**
     * @return bool
     */
    public function isActive()
    {
        if ($this->status == self::STATUS_ACTIVE) {
            return true;
        }

        return false;
    }

    public static function saveTags($array, $itemID)
    {
        $array = array_unique($array);

        foreach ($array as $item) {
            $item = Inflector::slug($item);
            /* @var $tag Tag */
            $tag = Tag::find()->where(['name' => $item])->one();

            if (empty($tag)) {
                $tag = new Tag();
                $tag->name = $item;
                $tag->frequency = 1;
                $tag->status = self::STATUS_ACTIVE;
                $tag->author_id = Yii::$app->user->identity->id;
                $tag->save();
            } else {
                $tag->frequencyIncrement();
            }

            ItemTag::connect($itemID, $tag->id);
        }
    }

    public static function popular()
    {
        return Tag::find()
            ->where(['status' => Tag::STATUS_ACTIVE])
            ->orderBy(['frequency' => SORT_DESC])
            ->limit(15)
            ->all();
    }
}
