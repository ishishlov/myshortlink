<?php

namespace Views\html\blocks;

class PageNotFound extends Block
{
    public function getHtml(): string
    {
        return '<p class="content">Страница не найдена <a href="/">На главную</a></p>';
    }
}
