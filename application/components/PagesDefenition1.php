<?php

namespace app\components;

use bupy7\bbcode\definitions;
use yii\helpers\Url;

class PagesDefenition1 extends \JBBCode\CodeDefinitionBuilder {
    public function __construct()
    {
        // HACK id указан пустым, как следствие он приклеится из значения {option}
        parent::__construct('page', '<a href="' . Url::to(['page/view', 'id' => '']) . 
                '{option}" page="{option}" class="page-link">{param}</a>');
        $this->setUseOption(true)->setParseContent(true);
    }
}

class PagesDefenition2 extends \JBBCode\CodeDefinitionBuilder {
    public function __construct()
    {
        // HACK id указан пустым, как следствие он приклеится из значения {param}
        parent::__construct('page', '<a href="' . Url::to(['page/view', 'id' => '']) .
                '{param}" page="{param}" class="page-link">{param}</a>');
    }
}

class PreviewDefenition1 extends \JBBCode\CodeDefinitionBuilder {
    public function __construct()
    {
        // HACK id указан пустым, как следствие он приклеится из значения {param}
        parent::__construct(
            'preview', <<<HTML
            <div class="img-preview"><span class="container">
                <img title="{param}" src="{option}"/>
                <span>{param}</span>
            </span></div>
HTML
        );
        $this->setUseOption(true)->setParseContent(true);
    }
}

class PreviewDefenition2 extends \JBBCode\CodeDefinitionBuilder {
    public function __construct()
    {
        // HACK id указан пустым, как следствие он приклеится из значения {param}
        parent::__construct(
            'preview', <<<HTML
            <div class="img-preview"><span class="container">
                <img src="{param}"/>
                <span style="color: transparent;">|</span>
            </span></div>
HTML
        );
    }
}