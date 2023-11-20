<?php

namespace Views\html;

class Index
{
    public static function render(HtmlBlock $content, ?HtmlBlock $errors = null): void
    {
        $errors = $errors ? $errors->getHtml() : '';

        echo '
            <!doctype html>
            <html lang="ru">
            <head>
                <meta charset="utf-8" />
                <title>Сокращаем ссылку</title>
                <link rel="stylesheet" href="public/css/style.css" />
            </head>
            <body>
            <div class="content">
                ' . $content->getHtml() . '
                <div class="errors">' . $errors . '</div>
            </div>
            </body>
            </html>
        ';

        exit();
    }
}
