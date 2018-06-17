<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\searches\VisitorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitor-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">
                        <i class="fa fa-user-secret" aria-hidden="true"></i> Lista IP
                    </h3>
                </div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}\n{summary}\n{pager}",
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['style' => 'width: 60px;']],

                            [
                                'label' => 'IP',
                                'attribute' => 'IP',
                                //'contentOptions' => ['style' => 'width: 50px'],
                                'format' => 'raw',
                                'value' => function ($data) {
                                    /* @var $data \app\modules\admin\models\Visitor */
                                    return Html::a($data->IP, ['visitor/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'label' => 'Typ',
                                'attribute' => 'type',
                                'contentOptions' => ['style' => 'width: 120px'],
                                'format' => 'raw',
                                //'filter' => Item::getStatusNames(),
                                'value' => function ($data) {
                                    /* @var $data \app\modules\admin\models\Visitor */
                                    return $data->getTypesName();
                                },
                            ],
                            [
                                'label' => 'Item',
                                'attribute' => 'item_id',
                                'contentOptions' => ['style' => 'width: 130px'],
                                'format' => 'raw',
                                'value' => function ($data) {
                                    /* @var $data \app\modules\admin\models\Visitor */
                                    return Html::a('Zobacz ID: ' . $data->item_id, ['item/view', 'id' => $data->item_id]);
                                },
                            ],
                            [
                                'attribute' => 'visit',
                                'format' => 'raw',
                                'contentOptions' => ['style' => 'width: 180px;'],
                            ],

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width: 110px'],
                                'template' => '{new_action1} {new_action2}',
                                'buttons' => [
                                    'new_action1' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Edytuj',
                                            ['visitor/update', 'id' => $model->id],
                                            ['title' => 'Edytuj', 'class' => 'btn btn-primary btn-xs']
                                        );
                                    },
                                    'new_action2' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Usuń',
                                            ['visitor/delete', 'id' => $model->id],
                                            [
                                                'title' => 'Usuń', 'class' => 'btn btn-danger btn-xs',
                                                'data-confirm' => 'Are you sure to delete this item?',
                                                'data-method' => 'post'
                                            ]
                                        );
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <?php Pjax::end(); ?>
</div>
