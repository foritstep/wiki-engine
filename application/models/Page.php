<?php

namespace app\models;

use bupy7\bbcode\BBCodeBehavior;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

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
                'codeDefinitionBuilder' => [
                    // HACK id указан пустым, как следствие он приклеится из значения {option}
                    function($builder) {
                        $builder->setTagName('page');
                        $builder->setReplacementText('<a href="' . Url::to(['page/view', 'id' => '']) . '{option}" class="page-link">{param}</a>');
                        $builder->setUseOption(true)->setParseContent(true);
                        return $builder->build();
                    },
                    // HACK id указан пустым, как следствие он приклеится из значения {param}
                    [ 'page', '<a href="' . Url::to(['page/view', 'id' => '']) . '{param}" class="page-link">{param}</a>' ],
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

    public function getEncoded_content() {
        return Html::encode($this->content);
    }
}
