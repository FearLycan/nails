<?php

use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'categories')->widget(Select2::classname(), [
                'data' => $categories,
                'options' => ['placeholder' => 'Kategorie', 'multiple' => true],
                'maintainOrder' => true,
                'pluginOptions' => [
                    'allowClear' => true,
                    'maximumInputLength' => 10
                ],
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'pl',
        'clientOptions' => [
            'branding' => false,
            'menubar' => false,
        ]
    ]); ?>

    <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-6">
            <?= $form->field($model, 'myFile')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                    'showCancel' => false
                ],
                'pluginEvents' => [
                ],
            ]); ?>
        </div>
    </div>

    <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-12">

            <?php
            $formatJs = <<< 'JS'
    var formatRepo = function (tag) {
        if (tag.loading) {
            return tag.name;
        }

        var markup = tag.name;

        return  markup;
    };
    var formatRepoSelection = function (tag) {
        return tag.name || tag.id;
    }
JS;
            // Register the formatting script
            $this->registerJs($formatJs, View::POS_HEAD);
            ?>


            <?= $form->field($model, 'tags')->widget(Select2::classname(), [
                //'data' => $shops,
                'options' => ['placeholder' => 'Tags...', 'multiple' => true],
                'showToggleAll' => false,
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ';'],
                    'maximumInputLength' => 15,
                    'maximumSelectionLength' => 10,

                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['tag/list']),
                        'dataType' => 'json',
                        'delay' => 250,
                        'data' => new JsExpression('function(params) { return {phrase:params.term, page:params.page}; }'),
                        'cache' => false,
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('formatRepo'),
                    'templateSelection' => new JsExpression('formatRepoSelection'),
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'status')->widget(Select2::classname(), [
                'data' => \app\modules\admin\models\Tag::getStatusNames(),
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
