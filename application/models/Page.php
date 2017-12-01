<?php

namespace app\models;

use bupy7\bbcode\BBCodeBehavior;
use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
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
                'attribute' => 'content',
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'purified_content' => 'Purified Content',
        ];
    }
}
