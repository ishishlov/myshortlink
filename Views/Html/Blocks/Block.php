<?php

namespace Views\Html\Blocks;

require_once 'Views\Html\HtmlBlock.php';

use Views\Html\HtmlBlock;

class Block implements HtmlBlock
{
    protected $text = '';

    protected function __construct(string $text)
    {
        $this->text = $text;
    }

    public static function create(?string $text = ''): self
    {
        return new static($text);
    }

    public function getHtml(): string
    {
        return '';
    }
}
