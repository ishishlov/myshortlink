<?php

namespace Services;

require_once 'Views\Blocks\Errors.php';
require_once 'Views\Blocks\Form.php';
require_once 'Views\Index.php';
require_once 'Models\ShortLinkStorage.php';

use DateTimeImmutable;
use Views\Blocks\Errors;
use Views\Blocks\Form;
use Views\Index;
use Models\ShortLinkStorage;

class MyShortLink
{
    private const SHORT_LINK_TEMPLATE = 'http://myshortlink.com/%s';

    public static function createTokenAndShowShortLink(OriginalLink $link) {
        $link->validation();
        if ($link->getError()) {
            Index::render(Form::getHtml(), Errors::getHtml($link->getError()));
        }

        $token = Token::generate();
        $result = (new ShortLinkStorage())->save($token, $link, new DateTimeImmutable());

        if (!$result) {
            Index::render(Form::getHtml(), Errors::getHtml('Попытайтесь еще раз'));
        }

        $shortLink = sprintf(self::SHORT_LINK_TEMPLATE, $token->get());
        $form = Form::getHtml($shortLink);
        Index::render($form);
    }
}