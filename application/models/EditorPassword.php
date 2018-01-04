<?php

namespace app\models;

use yii\base\Model;

class EditorPassword extends Model
{
    public $current;
    public $new;
    public $confirm;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['current', 'new', 'confirm'], 'required'],
            [['current', 'new', 'confirm'], 'string', 'max' => 255],
            ['new', 'compare', 'compareAttribute' => 'confirm']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'current' => 'Current password',
            'new' => 'New password',
            'confirm' => 'Confirm password',
        ];
    }
}
