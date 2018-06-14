<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="category-index">
        <?php Pjax::begin() ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">
                            <i class="fa fa-folder" aria-hidden="true"></i> Kategorie
                        </h3>
                        <div class="btn-group pull-right">
                            <a href="<?= Url::to(['create']) ?>" class="btn btn-success btn-sm">Dodaj</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'summary' => false,
                            // 'filterModel' => $searchModel,
                            'layout' => "{items}\n{summary}\n{pager}",
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['style' => 'width: 60px;']],

                                //'id',
                                'name',
                                //'slug',
                                //'description:ntext',
                                [
                                    'attribute' => 'author',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return Html::a($data->author->name, ['user/view', 'id' => $data->author_id]);
                                    },
                                    'contentOptions' => ['style' => 'width: 250px;'],
                                ],
                                [
                                    'attribute' => 'created_at',
                                    'format' => 'raw',
                                    'contentOptions' => ['style' => 'width: 230px;'],
                                ],
                                //'created_at',
                                //'updated_at',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions' => ['style' => 'width: 130px'],
                                    'template' => '{new_action1} {new_action2}',
                                    'buttons' => [
                                        'new_action1' => function ($url, $model, $key) {
                                            return Html::a(
                                                'Edytuj',
                                                ['category/update', 'id' => $model->id],
                                                ['title' => 'Edytuj', 'class' => 'btn btn-primary btn-sm']
                                            );
                                        },
                                        'new_action2' => function ($url, $model, $key) {
                                            return Html::a(
                                                'Usuń',
                                                ['category/delete', 'id' => $model->id],
                                                [
                                                    'title' => 'Usuń', 'class' => 'btn btn-danger btn-sm',
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
        <?php Pjax::end() ?>
    </div>

<?php $this->beginBlock('script') ?>
    <script>
        /*    $(document).ready(function () {
                $('.table').DataTable();
            });*/
    </script>
<?php $this->endBlock() ?>