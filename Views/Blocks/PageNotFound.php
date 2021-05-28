<?php

namespace Views\Blocks;

require_once 'Views\Blocks\HtmlBlock.php';

class PageNotFound implements HtmlBlock
{
    public static function getHtml(?string $text = ''): string
    {
        return '<div class="content">Страница не найдена <a href="/">На главную</a></div>';
    }
}
