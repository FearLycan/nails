<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Tag;

class TagForm extends Tag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['name'], 'string'],

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