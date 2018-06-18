<?php

use yii\helpers\Url;

$this->title = 'Rejestracja' . ' - ' . Yii::$app->params['name'];
?>

<?php $this->beginBlock('meta') ?>
<meta property="og:image" content="<?= Url::to('@web/images/seo/seo.jpg', true); ?>"/>
<meta name="description" content="<?= Yii::$app->params['description'] ?>"/>
<meta property="og:url" content="<?= Url::to(['auth/register'], true) ?>"/>
<meta property="og:title" content="<?= $this->title ?>"/>
<meta property="og:description" content="<?= Yii::$app->params['description'] ?>"/>
<?php $this->endBlock() ?>

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
    <div class="login-form registration-form">
        <?= $this->render('_registration-form', [
            'model' => $model,
        ]) ?>
    </div>
<?php endif; ?>
