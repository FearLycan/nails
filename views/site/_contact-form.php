<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \app\models\forms\ContactForm */

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <?= Html::submitButton('Wyślij', ['class' => 'btn btn-theme']) ?>
</div>

<?php ActiveForm::end(); ?>

