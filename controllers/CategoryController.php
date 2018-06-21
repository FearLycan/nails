<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Category;
use app\models\Item;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    public function actionView($slug)
    {
        $category = Category::find()
            ->where(['slug' => $slug, 'status' => Category::STATUS_ACTIVE])
            ->one();

        if (empty($category)) {
            $this->notFound();
        }

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
            'category' => $category,
        ]);
    }
}