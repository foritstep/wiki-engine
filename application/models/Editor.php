<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "editors".
 *
 * @property string $nick
 * @property string $email
 * @property string $password
 */
class Editor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'editors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nick', 'email', 'password'], 'required'],
            [['nick', 'email', 'password'], 'string', 'max' => 255],
            [['nick', 'email'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nick' => 'Nick',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}
