<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;

?>

<div class="col-lg-8 col-xs-12">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '_item',
    ]); ?>
</div>

<div class="col-lg-4 col-sm-4 col-xs-12 hidden-xs">
    <?= $this->render('../layouts/_sidebar', [
    ]) ?>
</div>
