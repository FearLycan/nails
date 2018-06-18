<?php


use yii\helpers\Url;

$this->title = 'Zaloguj się' . ' - ' . Yii::$app->params['name'];

?>

<?php $this->beginBlock('meta') ?>
<meta property="og:image" content="<?= Url::to('@web/images/seo/seo.jpg', true); ?>"/>
<meta name="description" content="<?= Yii::$app->params['description'] ?>"/>
<meta property="og:url" content="<?= Url::to(['auth/login'], true) ?>"/>
<meta property="og:title" content="<?= $this->title ?>"/>
<meta property="og:description" content="<?= Yii::$app->params['description'] ?>"/>
<?php $this->endBlock() ?>

<div class="login-form">
    <?= $this->render('_login-form', [
        'model' => $model,
    ]) ?>
</div>