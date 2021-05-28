<?php

namespace Views\Blocks;

require_once 'Views\Blocks\HtmlBlock.php';

class Form implements HtmlBlock
{
    public static function getHtml(?string $text = ''): string
    {
        $html = '
            <form action="/" method="post">
                <input type="edit" name="link" placeholder="Введите ссылку">
                <button type="submit">Генерировать</button>
            </form>
        ';

        if ($text) {
            $html .= '<p>Ваша короткая ссылка <a href="' . $text . '" target="_blank">' . $text . '</a></p>';
        }

        return $html;
    }
}