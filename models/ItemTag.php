<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%item_tag}}".
 *
 * @property int $item_id
 * @property int $tag_id
 *
 * @property Item $item
 * @property Tag $tag
 */
class ItemTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'tag_id'], 'required'],
            [['item_id', 'tag_id'], 'integer'],
            [['item_id', 'tag_id'], 'unique', 'targetAttribute' => ['item_id', 'tag_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    public static function connect($itemID, $tagID)
    {
        $connect = self::find()->where(['item_id' => $itemID, 'tag_id' => $tagID])->one();

        if (empty($connect)) {
            $connect = new ItemTag();
            $connect->item_id = $itemID;
            $connect->tag_id = $tagID;
            $connect->save();
        }
    }

    public static function deleteConnect($itemID)
    {
        $connects = self::find()->where(['item_id' => $itemID])->all();

        foreach ($connects as $connect) {
            $connect->tag->frequencyDecrement();
            $connect->delete();
        }
    }
}
