<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Category;
use app\models\Item;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

class CategoryController extends Controller
{
    public function actionView($slug)
    {
        $query = Item::find()
            ->joinWith('categories')
            ->where(['category.slug' => $slug, 'category.status' => Category::STATUS_ACTIVE]);

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
            'category' => Html::encode($slug),
        ]);
    }
}