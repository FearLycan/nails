<?php

use app\modules\admin\models\User;
use yii\helpers\Html;

/* @var $email \app\models\forms\ContactForm */


?>

    <h2>Wiadomość ze strony Nails by Martha</h2>

    <p>
        <?= Html::encode($email->name) ?>
    </p>

    <p>
        <?= Html::encode($email->email) ?>
    </p>

    <p>
        <?= Html::encode($email->message) ?>
    </p>

<?= $this->render('_message-footer', ['optional' => true]) ?>