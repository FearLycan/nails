<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Category;


class CategoryForm extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'in', 'range' => array_keys(static::getStatuses())],
            [['name', 'description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nazwa',
            'description' => 'Opis',
            'status' => 'Status',
        ];
    }
}