<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\models\Category;
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
    <meta name="keywords" content="<?= Yii::$app->params['keywords'] ?>" />
    <meta property="fb:pages" content="239323143282506" />
    <meta property="fb:app_id" content="1063640817146485" />
    <meta property="og:locale" content="pl_PL" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="<?= Yii::$app->params['name'] ?>" />
    <?= $this->blocks['meta'] ?>
    <?php $this->head() ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/icon/favicon.ico" type="image/x-icon" />
</head>
<body>

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v3.0&appId=1063640817146485&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


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

    $items[] = ['label' => 'Home', 'url' => ['/']];
    $items[] = ['label' => 'Popularne', 'url' => ['/popularne']];

    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdministrator()) {
        $items[] = ['label' => 'Admin', 'url' => ['/admin']];
    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="submenu">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="category-menu">
                        <?php foreach (Category::find()->where(['status' => Category::STATUS_ACTIVE])->all() as $category): ?>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['category/view', 'slug' => $category->slug]) ?>"><?= $category->name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mtb">
        <?= $content ?>
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
                <h4>Dołącz do Nas</h4>
                <div class="hline-w"></div>
                <p>
                    <a href="https://www.facebook.com/nailsbyMartha00/" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
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
