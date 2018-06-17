<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Item;
use app\models\Tag;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

class TagController extends Controller
{
    public function actionView($slug)
    {
        $query = Item::find()
            ->joinWith('tags')
            ->where(['tag.name' => $slug, 'tag.status' => Tag::STATUS_ACTIVE]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'tag' => Html::encode($slug),
        ]);
    }
}