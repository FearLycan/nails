<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Category;
use app\models\Item;
use app\models\searches\ItemSearch;
use Yii;

class ItemController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug)
    {
        /* @var \app\models\Item $model */
        $model = Item::find()->where(['slug' => $slug])->one();

        if (empty($model)) {
            $this->notFound();
        }

        $items = $model->getMoreFromCategory(8);

        $model->visit();

        return $this->render('view', [
            'model' => $model,
            'items' => $items
        ]);
    }

    public function actionPopular()
    {
        $query = Item::find()->where(['status' => Category::STATUS_ACTIVE]);

        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        $dataProvider->sort->defaultOrder = ['views' => SORT_DESC];

        return $this->render('popular', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
