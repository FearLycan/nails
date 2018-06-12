<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model \app\models\forms\LoginForm */

?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => false,
    'options' => ['class' => 'form-default'],
]) ?>

<div class="row" style="margin-bottom: 10px;">
    <div class="col-12">
        <?= $form->field($model, 'email')->textInput([
            'class' => 'form-control form-control-lg'
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?= $form->field($model, 'password')->passwordInput([
            'class' => 'form-control form-control-lg'
        ]) ?>
    </div>
</div>

<!--<div class="row">-->
<!--    <div class="col-12">-->
<!--        <div class="checkbox">-->
<!--            <input type="checkbox" id="chkRemember">-->
<!--            <label for="chkRemember">Zapamiętaj mnie</label>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="row">
    <div class="col-12">
        <?= Html::submitButton('Zaloguj się', ['class' => 'btn btn-styled btn-lg btn-block btn-base-1 mt-4']) ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="mt-1 ">
            <small>
               <!-- <a href="<?/*= Url::toRoute(['site/reset']); */?>">Nie pamiętasz hasła?</a>-->
            </small>
        </div>
    </div>
</div>

<?php ActiveForm::end() ?>