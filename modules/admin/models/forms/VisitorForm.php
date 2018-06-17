<?php

namespace app\modules\admin\models\forms;


use app\modules\admin\models\Visitor;

class VisitorForm extends Visitor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IP', 'type'], 'required'],
        ];
    }
}