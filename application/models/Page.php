<?php

namespace app\models;

use bupy7\bbcode\BBCodeBehavior;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "pages".
 *
 * @property string $title
 * @property string $content
 * @property string $purified_content
 */
class Page extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => BBCodeBehavior::className(),
                'attribute' => 'encoded_content',
                'saveAttribute' => 'purified_content',
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content', 'purified_content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'content' => 'Content',
            'purified_content' => 'Purified Content',
        ];
    }

    public function getEncoded_content() {
        return Html::encode($this->content);
    }
}
