<?php

namespace Views;

class Index
{
    public static function render(string $content, ?string $errors = ''): void
    {
        echo '
            <!doctype html>
            <html lang="ru">
            <head>
                <meta charset="utf-8" />
                <title>Сокращаем ссылку</title>
                <link rel="stylesheet" href="style.css" />
            </head>
            <body>
            <div class="content">' . $content . '</div>
            <div class="errors">' . $errors . '</div>
            </body>
            </html>
        ';

        exit();
    }
}
