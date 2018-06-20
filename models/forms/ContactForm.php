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
            [['name', 'email'], 'string', 'max' => 120],
            [['name', 'email', 'message'], 'required'],
        ];
    }


    public function send()
    {
        $email = Yii::$app->mailer->compose('contact', ['email' => $this])
            ->setFrom(Yii::$app->params['email'])
            ->setTo('damian.bronczyk@gmail.com')
            ->setSubject('Wiadomość ze strony Nails by Martha')
            ->send();

        return $email;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nazwa',
            'email' => 'Adres email',
            'message' => 'Treść wiadomości',
        ];
    }
}