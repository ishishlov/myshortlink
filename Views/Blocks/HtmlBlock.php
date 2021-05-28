<?php

namespace Views\Blocks;

interface HtmlBlock
{
    public static function getHtml(?string $text = ''): string;
}