<?php

namespace app\models;

use bupy7\bbcode\BBCodeBehavior;
use GlHtml\GlHtml;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;

/**
 * This is the model class for table "pages".
 *
 * @property string $title
 * @property string $content
 * @property string $purified_content
 */
class Page extends \yii\db\ActiveRecord
{
    use \app\components\BB2HtmlTrait;

    public function behaviors()
    {
        return [
            [
                'class' => BBCodeBehavior::className(),
                'attribute' => 'encoded_content',
                'saveAttribute' => 'purified_content',
                'codeDefinitionBuilder' => [
                    '\app\components\PagesDefenition1',
                    '\app\components\PagesDefenition2',
                    '\app\components\PreviewDefenition1',
                    '\app\components\PreviewDefenition2',
                    [ 'tag', '<blockquote>{param}</blockquote>' ],
                    'bupy7\bbcode\definitions\DefaultCodeDefinitionSet',
                ],
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
}
