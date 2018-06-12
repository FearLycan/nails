<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model \app\models\forms\RegistrationForm */

?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'id' => 'registration-form',
    'options' => ['class' => 'form-default mt-4'],
]) ?>

<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput([
            'class' => 'form-control form-control-lg'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'email')->textInput([
            'class' => 'form-control form-control-lg'
        ]) ?>
    </div>
</div>

<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-6">
        <?= $form->field($model, 'password_first')->passwordInput([
            'class' => 'form-control form-control-lg'
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'password_second')->passwordInput([
            'class' => 'form-control form-control-lg'
        ]) ?>
    </div>
</div>

<div class="mt-1 ">
    <small>
        <a href="<?= Url::toRoute(['page/view' , 'slug' => 'regulamin']); ?>">Klikając "Zarejestruj się", akceptujesz nasze regulamin.</a>
    </small>
</div>

<div class="row">
    <div class="col-12">
        <?= Html::submitButton('Zarejestruj się', ['class' => 'btn btn-styled btn-lg btn-block btn-base-1 mt-4']) ?>
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


