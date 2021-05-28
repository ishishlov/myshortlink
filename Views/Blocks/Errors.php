<?php

namespace Views\Blocks;

require_once 'Views\Blocks\HtmlBlock.php';

class Errors implements HtmlBlock
{
    public static function getHtml(?string $text = ''): string
    {
        return '<div class="error">' . $text . '</div>';
    }
}
