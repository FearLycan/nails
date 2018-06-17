<?php

namespace app\models;

use app\components\SluggableBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property int $status
 * @property int $views
 * @property int $author_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $author
 */
class Item extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_PENDING = 2;

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
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status', 'author_id', 'views'], 'integer'],
            [['author_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'slug' => 'Slug',
            'image' => 'Image',
            'description' => 'Description',
            'status' => 'Status',
            'views' => 'Views',
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
            static::STATUS_PENDING => 'Oczekujący',
            static::STATUS_INACTIVE => 'Nieaktywny',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return self::getStatusNames()[$this->status];
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            static::STATUS_ACTIVE,
            static::STATUS_PENDING,
            static::STATUS_INACTIVE,
        ];
    }

    /**
     * @return array
     */
    public static function getActiveStatuses()
    {
        return [
            static::STATUS_ACTIVE,
        ];
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return in_array($this->status, self::getActiveStatuses());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%item_tag}}', ['item_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%item_category}}', ['item_id' => 'id']);
    }

    public function getMoreFromCategory($n)
    {
        $categories = $this->categories;

        $ids = ArrayHelper::getColumn($categories, 'id');

        $items = self::find()
            ->joinWith('categories')
            ->where(['category.id' => $ids])
            ->andWhere(['!=', 'item.id', $this->id])
            ->orderBy(new Expression('rand()'))
            ->limit($n)
            ->all();

        return $items;
    }

    public static function getPopular()
    {
        $items = Item::find()
            ->where(['status' => Item::STATUS_ACTIVE])
            ->orderBy(['views' => SORT_DESC])
            ->limit(5)
            ->all();

        return $items;
    }

    public function visit()
    {
        $IP = Yii::$app->getRequest()->getUserIP();
        $time = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime(date('Y-m-d H:i:s'))));

        $visitor = Visitor::find()
            ->where(['IP' => $IP, 'item_id' => $this->id])
            ->one();

        if (empty($visitor)) {
            $visitor = new Visitor();
            $visitor->IP = $IP;
            $visitor->item_id = $this->id;
            $visitor->type = Visitor::TYPE_NORMAL;
            $visitor->save();
        } elseif ($visitor->type == Visitor::TYPE_NORMAL && $visitor->visit <= $time) {
            //aktualizacja czasu i +1 do views
            $visitor->visit = date('Y-m-d H:i:s');
            $visitor->save();

            $this->views++;
            $this->save(false, ['views']);
        } else {
            $visitor->visit = date('Y-m-d H:i:s');
            $visitor->save();
        }
    }

    public function removeImageFile()
    {
        if (file_exists(Image::URL . $this->image && Image::URL_THUMBNAIL . $this->image)) {
            unlink(Image::URL . $this->image);
            unlink(Image::URL_THUMBNAIL . $this->image);
            unlink(Image::URL_SMALL . $this->image);
        }
    }
}
