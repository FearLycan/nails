<?php
/**
 * Created by PhpStorm.
 * User: Damian Brończyk
 * Date: 20.06.2018
 * Time: 12:57
 */

namespace app\models\forms;


use Yii;
use yii\db\ActiveRecord;

class ContactForm extends ActiveRecord
{
    public $name;
    public $email;
    public $message;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['email'], 'email'],
            [['name'], 'string', 'max' => 120],
        ];
    }


    public function send()
    {
        Yii::$app->mailer->compose('contact', ['email' => $this])
            ->setFrom(Yii::$app->params['email'])
            ->setTo('damian.bronczyk@gmail.com')
            ->setSubject('Wiadomość ze strony Nails by Martha')
            ->send();
    }
}