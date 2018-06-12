<?php


use yii\helpers\Url;

$this->title = 'Zaloguj się' . ' | ' . Yii::$app->params['name'];

?>

<div class="login-form">
    <?= $this->render('_login-form', [
        'model' => $model,
    ]) ?>
</div>