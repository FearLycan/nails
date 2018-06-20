<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Kontakt';

?>

<div id="blue">
    <div class="container">
        <div class="row">
            <h3>Skontaktuj się z nami</h3>
        </div><!-- /row -->
    </div> <!-- /container -->
</div>


<div class="site-contact">
    <div class="row">
        <div class="col-lg-8 col-xs-12">
            <h4>Znalazłeś błąd na stronie lub po prostu chcesz do nas napisać? </h4>
            <div class="hline"></div>

            <p>Skorzystaj z poniższego formularza.</p>

            <?php if ($status == true): ?>
                <div class="alert alert-success" role="alert">
                    <strong>Świetnie!</strong> Twoja wiadomość została wysłana.
                </div>
            <?php elseif ($status == 'error'): ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Uwaga!</strong> Wystąpił błąd, proszę spóbować później.
                </div>
            <?php endif; ?>

            <?= $this->render('_contact-form', [
                'model' => $model,
            ]) ?>
        </div><!-- --/col-lg-8 ---->

        <div class="col-lg-4">
            <h4>Dodatkowe informacje</h4>
            <div class="hline" style="margin-bottom: 20px;"></div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Reklama</h3>
                </div>
                <div class="panel-body">
                    W sprawie reklamy pisz na
                    <a style="font-size: 17px; font-weight: bold;"
                       href="mailto:<?= Yii::$app->params['email'] ?>"><?= Yii::$app->params['email'] ?></a>
                </div>
            </div>

        </div>
    </div>
</div>
