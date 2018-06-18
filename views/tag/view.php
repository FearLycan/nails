<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Tag ' . $tag . ' - ' . Yii::$app->params['name'];

?>

<?php $this->beginBlock('meta') ?>
<meta property="og:image" content="<?= Url::to('@web/images/seo/seo.jpg', true); ?>"/>
<meta name="description" content="<?= Yii::$app->params['description'] ?>"/>
<meta property="og:url" content="<?= Url::to(['tag/view', 'slug' => $tag], true) ?>"/>
<meta property="og:title" content="<?= $this->title ?>"/>
<meta property="og:description" content="<?= Yii::$app->params['description'] ?>"/>
<?php $this->endBlock() ?>

<div id="blue">
    <div class="container">
        <div class="row">
            <h3>#<?= $tag ?></h3>
        </div><!-- /row -->
    </div> <!-- /container -->
</div>

<div class="col-lg-8 col-xs-12">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '../item/_item',
    ]); ?>
</div>

<div class="col-lg-4 col-sm-4 col-xs-12 hidden-xs">
    <?= $this->render('../layouts/_sidebar', [
    ]) ?>
</div>
