<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%visitor}}".
 *
 * @property int $id
 * @property int $type
 * @property int $item_id
 * @property string $IP
 * @property string $visit
 */
class Visitor extends \yii\db\ActiveRecord
{
    const TYPE_NORMAL = 0;
    const TYPE_BOT = 1;
    const TYPE_TRUST = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%visitor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IP', 'type', 'item_id'], 'required'],
            [['visit'], 'safe'],
            [['IP'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'IP' => 'IP',
            'visit' => 'Visit',
            'item_id' => 'Item ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return string[]
     */
    public static function getTypesNames()
    {
        return [
            static::TYPE_NORMAL => 'Zwykły',
            static::TYPE_BOT => 'Bot',
            static::TYPE_TRUST => 'Zaufany',
        ];
    }

    /**
     * @return string
     */
    public function getTypesName()
    {
        return self::getTypesNames()[$this->type];
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            static::TYPE_NORMAL,
            static::TYPE_BOT,
            static::TYPE_TRUST,
        ];
    }
}
