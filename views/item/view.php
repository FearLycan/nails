<?php
/* @var $model \app\models\Item */

use app\components\Helpers;
use yii\helpers\Html;
use yii\helpers\Url;

?>

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
                                        <a href="#" class="category"><?= $category->name ?></a>
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

                    <?php if (!empty($model->description)): ?>
                        <div class="content">
                            <h2>Opis</h2>
                            <div class="description">
                                <?= Html::encode($model->description) ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

<?php if (!empty($items)): ?>
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