<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%item_category}}".
 *
 * @property int $item_id
 * @property int $category_id
 */
class ItemCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'category_id'], 'required'],
            [['item_id', 'category_id'], 'integer'],
            [['item_id', 'category_id'], 'unique', 'targetAttribute' => ['item_id', 'category_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'category_id' => 'Category ID',
        ];
    }

    public static function connect($itemID, $categoryID)
    {
        $connect = self::find()->where(['item_id' => $itemID, 'category_id' => $categoryID])->one();

        if (empty($connect)) {
            $connect = new ItemCategory();
            $connect->item_id = $itemID;
            $connect->category_id = $categoryID;
            $connect->save();
        }
    }

    public static function deleteConnect($itemID)
    {
        $connects = self::find()->where(['item_id' => $itemID])->all();

        foreach ($connects as $connect) {
            //$connect->tag->frequencyDecrement();
            $connect->delete();
        }
    }
}
