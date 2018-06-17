<h4>Search</h4>
<div class="hline"></div>
<p>
    <form action="<?= yii\helpers\Url::home() ?>" method="get">
        <input type="text" class="form-control" name="title" placeholder="Search something">
    </form>
</p>

<div class="spacing"></div>

<h4>Najczęściej oglądane</h4>
<div class="hline"></div>
<ul class="popular-posts">

    <?php foreach (\app\models\Item::getPopular() as $item): ?>
        <li>
            <a href="<?= \yii\helpers\Url::to(['item/view', 'slug' => $item->slug]) ?>">
                <img src="<?= \yii\helpers\Url::to(['/images/item/70x70/' . $item->image]) ?>"
                     alt="<?= $item->title ?>">
            </a>
            <p>
                <a href="<?= \yii\helpers\Url::to(['item/view', 'slug' => $item->slug]) ?>">
                    <?= \yii\helpers\Html::encode($item->title) ?>
                </a>
            </p>
            <em><?= \Yii::$app->formatter->asDate($item->created_at, 'long'); ?></em>
        </li>
    <?php endforeach; ?>

</ul>

<div class="spacing"></div>

<h4>Popularne tagi</h4>
<div class="hline"></div>
<p>
    <?php foreach (\app\models\Tag::popular() as $tag): ?>
        <a class="btn btn-theme" href="<?= \yii\helpers\Url::to(['tag/view', 'slug' => $tag->name]) ?>">
            <?= $tag->name ?>
        </a>
    <?php endforeach; ?>
</p>
