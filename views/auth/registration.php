<?php

use yii\helpers\Url;

$this->title = 'Rejestracja' . ' | ' . Yii::$app->params['name'];
?>

<?php if ($status == true): ?>
    <section class="slice--offset slice sct-color-1" id="register">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ">
                    <div class="heading-3 strong-300 line-height-1_8">
                        <span class="c-base-1 strong-500"><?= $model->name ?>!</span> Na Twóją pocztę został wysłany
                        link aktywacyjny.
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <!--    <section class="slice-lg has-bg-cover bg-size-cover" id="register" style="background-image: url(../images/site/login-image-02.jpg); background-position: bottom center;">-->
    <section class="slice-lg has-bg-cover bg-size-cover" id="register">
        <div class="container">
            <div class="row justify-content-center cols-xs-space">
                <div class="col-lg-6">
                    <div class="form-card form-card--style-2 z-depth-2-top">
                        <div class="form-header text-center">
                            <div class="form-header-icon">
                                <i class="icon ion-log-in"></i>
                            </div>
                        </div>
                        <div class="form-body">

                            <div class="text-center px-2">
                                <h4 class="heading heading-4 strong-400 mb-4">Utwórz swoje konto</h4>
                            </div>

                            <?= $this->render('_registration-form', [
                                'model' => $model,
                            ]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php endif; ?>

<?php $this->beginBlock('script') ?>
<?php $this->endBlock() ?>