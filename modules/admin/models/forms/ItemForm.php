<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Item;

class ItemForm extends Item
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }
}