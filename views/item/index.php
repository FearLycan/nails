<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;

?>

<div class="col-lg-8 col-xs-12">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        //'itemOptions' => ['class' => 'col-lg-4 space-xs-md'],
        'itemView' => '_item',
        'options' => [
           // 'tag' => 'div',
           // 'class' => 'row cols-md-space cols-sm-space cols-xs-space',
        ],
    ]); ?>
</div>

<div class="col-lg-4 col-sm-4 col-xs-12 hidden-xs">
    <?= $this->render('../layouts/_sidebar', [
        //'model' => $model,
        //'categories' => $categories,
    ]) ?>
</div>
