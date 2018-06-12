<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['name'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="submenu">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="category-menu">
                        <li><a href="#">Humor</a></li>
                        <li><a href="#">Filmiki</a></li>
                        <li><a href="#">Laski</a></li>
                        <li><a href="#">Komiksy</a></li>
                        <li><a href="#">Galeria</a></li>
                        <li><a href="#">Ciekawostki</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mtb">

        <!-- BLOG POSTS LIST -->
        <div class="col-lg-8">
            <?= $content ?>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">
            <?= $this->render('_sidebar') ?>
        </div>

    </div>
</div>

<div id="footerwrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4>About</h4>
                <div class="hline-w"></div>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s.</p>
            </div>
            <div class="col-lg-4 col-lg-offset-4">
                <h4>Social Links</h4>
                <div class="hline-w"></div>
                <p>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-tumblr"></i></a>
                </p>
            </div>
            <div class="col-lg-4">
            </div>

        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
