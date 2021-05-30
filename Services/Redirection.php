<?php

namespace Services;

require_once 'Views\Html\Blocks\Errors.php';
require_once 'Views\Html\Blocks\Form.php';
require_once 'Views\Html\Index.php';
require_once 'Models\ShortLinkStorage.php';

use Views\Html\Blocks\Errors;
use Views\Html\Blocks\Form;
use Views\Html\Index;

class Redirection
{
    public static function getLinkAndRedirect(string $token, Storage $storage): self
    {
        $link = $storage->getOriginalLink($token);
        if ($link) {
            header('Location: ' . $link);
        } else {
            Index::render(
                Form::create(),
                Errors::create('Такой ссылки не существует')
            );
        }
    }
}
