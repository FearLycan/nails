<h4>Search</h4>
<div class="hline"></div>
<p>
    <br/>
    <input type="text" class="form-control" placeholder="Search something">
</p>

<div class="spacing"></div>

<h4>Recent Posts</h4>
<div class="hline"></div>
<ul class="popular-posts">
    <li>
        <a href="#"><img src="http://via.placeholder.com/140x140" alt="Popular Post"></a>
        <p><a href="#">Lorem ipsum dolor sit amet consectetur adipiscing elit</a></p>
        <em>Posted on 02/21/14</em>
    </li>
    <li>
        <a href="#"><img src="http://via.placeholder.com/70x70" alt="Popular Post"></a>
        <p><a href="#">Lorem ipsum dolor sit amet consectetur adipiscing elit</a></p>
        <em>Posted on 03/01/14</em>
    <li>
        <a href="#"><img src="http://via.placeholder.com/70x70" alt="Popular Post"></a>
        <p><a href="#">Lorem ipsum dolor sit amet consectetur adipiscing elit</a></p>
        <em>Posted on 05/16/14</em>
    </li>
    <li>
        <a href="#"><img src="http://via.placeholder.com/70x70" alt="Popular Post"></a>
        <p><a href="#">Lorem ipsum dolor sit amet consectetur adipiscing elit</a></p>
        <em>Posted on 05/16/14</em>
    </li>
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
