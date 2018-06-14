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
            [['name', 'description'], 'string'],
            [['status'], 'required'],
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