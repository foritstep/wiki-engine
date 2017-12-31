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