<?php

namespace Views\Html\Blocks;

require_once 'Views\Html\Blocks\Block.php';

class PageNotFound extends Block
{
    public function getHtml(): string
    {
        return '<p class="content">Страница не найдена <a href="/">На главную</a></p>';
    }
}
