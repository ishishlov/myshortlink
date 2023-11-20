<?php

namespace Views\html\blocks;

class Errors extends Block
{
    public function getHtml(): string
    {
        return '<div class="error">' . $this->text . '</div>';
    }
}
