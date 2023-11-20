<?php

namespace Views\html\blocks;

class Form extends Block
{
    public function getHtml(): string
    {
        $html = '
            <h1>Создайте свою ссылку</h1>
            <form class="flex-form" action="/" method="post">
                <input type="edit" name="link" placeholder="Введите ссылку">
                <button type="submit">Генерировать</button>
            </form>
        ';

        if ($this->text) {
            $html .= '<p>Ваша короткая ссылка <a href="' . $this->text . '" target="_blank">' . $this->text . '</a></p>';
        }

        return $html;
    }
}