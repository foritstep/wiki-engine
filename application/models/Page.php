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

    public function purifiedContent()
    {
        if($this->purified_content === '' || $this->purified_content === null) {
            if($this->content !== '' && $this->content !== null) {
                $this->save();
            } else {
                return '';
            }
        }
        $dom = new GlHtml($this->purified_content);
        $l = $dom->get('.page-link[href^="/web/index.php?r=page%2Fview&id="]');
        
        if(count($l) == 0) return $this->purified_content;
        foreach($l as $i) {
            parse_str(parse_url($i->getAttribute('href'), PHP_URL_QUERY), $output);
            $links[] = $output['id'];
            $c[] = [$i, $output['id']]; 
        }
        $exist = $this->find()->where(['in', 'title', $links])->all();
        $e = [];
        foreach($exist as $i) {
           $e[] = $i->title;
        }
        foreach($c as $k) {
            if(!in_array($k[1], $e)) {
                $k[0]->setAttributes(['class' => 'page-doesnt-exist']);
            }
        }
        return $dom->html();
    }
}
