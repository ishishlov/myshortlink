<?php

namespace Services;

require_once 'Views\Blocks\Errors.php';
require_once 'Views\Blocks\Form.php';
require_once 'Views\Index.php';
require_once 'Models\ShortLinkStorage.php';

use Views\Blocks\Errors;
use Views\Blocks\Form;
use Views\Index;
use Models\ShortLinkStorage;

class Redirection
{
    public static function getLinkAndRedirect($token): self
    {
        $link = (new ShortLinkStorage())->getOriginalLink($token);
        if ($link) {
            header('Location: ' . $link);
        } else {
            Index::render(Form::getHtml(), Errors::getHtml('Такой ссылки не существует'));
        }
    }
}
