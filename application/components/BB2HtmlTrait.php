<?php

namespace app\components;

use bupy7\bbcode\BBCodeBehavior;
use GlHtml\GlHtml;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;

trait BB2HtmlTrait {
    public function getEncoded_content() {
        return Html::encode($this->content);
    }

    public function getDom() {
        if($this->purified_content === '' || $this->purified_content === null) {
            if($this->content !== '' && $this->content !== null) {
                $this->save();
            } else {
                return '';
            }
        }
        return new GlHtml($this->purified_content);
    }

    public function purifiedContent()
    {
        $dom = $this->getDom();
        $html = $this->purified_content;
        foreach (['linkHighlighting', 'headers'] as $key) {
            $this->$key($dom, $html);
        }
        return $html;
    }

    public function linkHighlighting($dom, &$html)
    {
        $l = $dom->get('.page-link');

        if(count($l) == 0) return;
        foreach($l as $i) {
            $text = str_replace('+', ' ', $i->getAttribute('page'));
            $links[] = $text;
            $c[] = [$i, $text];
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
        $html = $dom->html();
    }

    public function array2Tree($arr, $n) {
        $t = '';
        foreach($arr as $i) {
            if(is_array($i)) {
                $t .= "<div class='indent'>{$this->array2Tree($i, $n + 1)}</div>";
            } else {
                $t .= "<div><a href='#$i'>$i</a></div>";
            }
        }
        return $t;
    }

    private function arrayFromHeader(&$headers, $current, $value) {
        if($current == 1) {
            $headers[] = $value;
        } else {
            if(is_array(end($headers))) {
                $this->arrayFromHeader($headers[count($headers) - 1], $current - 1, $value);
            } else {
                $headers[] = [$value];
            }
        }
    }

    public function headers($dom, &$html)
    {
        $l = $dom->get('h1, h2, h3, h4, h5, h6');
        if(count($l) == 0) return;
        $headers = [];
        $last = 1;
        $keys = ['h1' => 1, 'h2' => 2, 'h3' => 3, 'h4' => 4, 'h5' => 5, 'h6' => 6, ];
        foreach($l as $i) {
            $this->arrayFromHeader($headers, $keys[$i->getName()], $i->getText());
            $i->replaceMe("<a name='{$i->getText()}'><{$i->getName()}>{$i->getText()}</{$i->getName()}></a>");
        }
        echo '<div class="headers">' . $this->array2Tree($headers, 0) . '</div>';
        $html = $dom->html();
    }
}