<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::$app->params['name'];

?>

<?php $this->beginBlock('meta') ?>
<meta property="og:image" content="<?= Url::to('@web/images/seo/seo.jpg', true); ?>"/>
<meta name="description" content="<?= Yii::$app->params['description'] ?>"/>
<meta property="og:url" content="<?= Yii::$app->params['url'] ?>"/>
<meta property="og:title" content="<?= $this->title ?>"/>
<meta property="og:description" content="<?= Yii::$app->params['description'] ?>"/>
<?php $this->endBlock() ?>

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
