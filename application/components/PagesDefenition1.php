<?php

namespace app\components;

use bupy7\bbcode\definitions;
use yii\helpers\Url;

class PagesDefenition1 extends \JBBCode\CodeDefinitionBuilder {
    public function __construct()
    {
        parent::__construct('page', '<a href="' . Url::to(['page/view', 'id' => '']) . '{option}" class="page-link">{param}</a>');
        $this->setUseOption(true)->setParseContent(true);
    }
}

class PagesDefenition2 extends \JBBCode\CodeDefinitionBuilder {
    public function __construct()
    {
        parent::__construct('page', '<a href="' . Url::to(['page/view', 'id' => '']) . '{param}" class="page-link">{param}</a>');
    }
}