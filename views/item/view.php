<?php
/* @var $model \app\models\Item */

use app\components\Helpers;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title . ' - ' . Yii::$app->params['name'];

?>

<?php $this->beginBlock('meta') ?>
    <meta property="og:image" content="<?= Url::to('@web/images/item/thumbnail/' . $model->image, true); ?>"/>
    <meta name="description" content="<?= Yii::$app->params['description'] ?>"/>
    <meta property="og:url" content="<?= Url::to(['item/view', 'slug' => $model->slug], true) ?>"/>
    <meta property="og:title" content="<?= $this->title ?>"/>
    <meta property="og:description" content="<?= Yii::$app->params['description'] ?>"/>
<?php $this->endBlock() ?>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="media-element">
                <div class="box fav">
                    <div class="user-bar">
                        <div class="content">
                            <h2>
                                <a href="<?= Url::to(['item/view', 'slug' => $model->slug]) ?>" class="user">
                       <span class="name">
                           <?= Helpers::cutThis($model->title, 80) ?>
                       </span>
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div class="content">
                        <div class="toolbar">

                            <div class="row">
                                <div class="col-lg-12">
                                    <?php foreach ($model->categories as $category): ?>
                                        <a href="<?= Url::to(['category/view', 'slug' => $category->slug]) ?>" class="category">
                                            <?= $category->name ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="tag-list">
                                <?php foreach ($model->tags as $tag): ?>
                                    <a href="#">#<?= $tag->name ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <figure class="figure">
                        <a href="<?= Url::to(['item/view', 'slug' => $model->slug]) ?>">
                            <?= Html::img('@web/images/item/' . $model->image, ['alt' => $model->title, 'class' => 'full-image', 'width' => 610]) ?>
                        </a>
                    </figure>

                </div>
            </div>
        </div>
    </div>

<?php if (!empty($model->description)): ?>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h2-description">Dodatkowy opis</h2>
                    </div>
                </div>
                <div class="description">
                    <?= $model->description ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <h6>SHARE:</h6>
                        <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                             data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank"
                                                                                                       href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                                                                                       class="fb-xfbml-parse-ignore">Udostępnij</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator"
                 data-width="100%" data-numposts="10"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <hr>
        </div>
    </div>

<?php if (!empty($items)): ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="h2-description see-more">Zobacz więcej z:

                <?php foreach ($model->categories as $key => $category): ?>

                    <?php if (count($model->categories) - 1 > $key): ?>
                        <?= Html::a($category->name, ['category/view', 'slug' => $category->slug]) ?>,
                    <?php else: ?>
                        <?= Html::a($category->name, ['category/view', 'slug' => $category->slug]) ?>.
                    <?php endif; ?>

                <?php endforeach; ?>

            </h3>
        </div>
    </div>


    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col-lg-3">
                <a href="<?= Url::to(['item/view', 'slug' => $item->slug]) ?>">
                <span class="img-more"
                      style="background-image:url(<?= Url::to(['/images/item/thumbnail/' . $item->image]) ?>);"></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>