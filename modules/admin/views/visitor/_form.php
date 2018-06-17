<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Visitor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IP')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'type')->widget(Select2::classname(), [
                'data' => \app\modules\admin\models\Visitor::getTypesNames(),
                'options' => ['placeholder' => 'Status'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
