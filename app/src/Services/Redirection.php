<?php

namespace App\Services;

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
