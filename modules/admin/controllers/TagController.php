<?php

namespace app\modules\admin\controllers;

use app\components\Inflector;
use app\modules\admin\models\forms\TagForm;
use Yii;
use app\modules\admin\models\Tag;
use app\modules\admin\models\searches\TagSearch;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TagForm();
        $model->status = Tag::STATUS_ACTIVE;


        if ($model->load(Yii::$app->request->post())) {

            $model->author_id = Yii::$app->user->identity->id;
            $model->frequency = 0;
            $model->name = Inflector::slug($model->name);
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Get options for Select2 widget in offer form.
     *
     * @param string $phrase
     * @param int $page
     * @return array
     */
    public function actionList($phrase, $page = 1)
    {
        $limit = 20;

        $tags = Tag::find()->select(['id', 'name'])
            ->where(['status' => Tag::STATUS_ACTIVE])
            ->andWhere(['like', 'name', $phrase])
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->all();

        $results = [];
        /* @var $tag Tag */
        foreach ($tags as $tag) {
            $results[] = [
                'id' => $tag->name,
                'name' => $tag->name,
            ];
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'results' => $results,
            'pagination' => [
                'page' => $page,
                'more' => count($results) === $limit,
            ],
        ];
    }
}
