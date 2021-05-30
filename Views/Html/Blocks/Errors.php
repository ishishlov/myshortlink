<?php

namespace Views\Html\Blocks;

require_once 'Views\Html\Blocks\Block.php';

class Errors extends Block
{
    public function getHtml(): string
    {
        return '<div class="error">' . $this->text . '</div>';
    }
}
