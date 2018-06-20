<?php

namespace app\controllers;

use app\models\forms\ContactForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }

    public function actionContact($status = false)
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post())) {
            $ok = $model->send();

            if ($ok) {
                $status = true;
                return $this->redirect(['/kontakt', 'status' => $status]);
            } else {
                $status = 'error';
            }
        }

        return $this->render('contact', [
            'model' => $model,
            'status' => $status,
        ]);
    }
}
