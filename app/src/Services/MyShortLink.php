<?php

namespace App\Services;

use DateTimeImmutable;
use Views\Html\Blocks\Errors;
use Views\Html\Blocks\Form;
use Views\Html\Index;

class MyShortLink
{
    private const SHORT_LINK_TEMPLATE = 'http://myshortlink.com/%s';

    public static function createTokenAndShowShortLink(OriginalLink $link, Storage $storage) {
        $link->validation();
        if ($link->getError()) {
            Index::render(
                Form::create(),
                Errors::create($link->getError())
            );
        }

        $token = Token::generate();
        $result = $storage->save($token, $link, new DateTimeImmutable());

        if (!$result) {
            Index::render(
                Form::create(),
                Errors::create('Попытайтесь еще раз')
            );
        }

        $shortLink = sprintf(self::SHORT_LINK_TEMPLATE, $token->get());
        Index::render(Form::create($shortLink));
    }
}