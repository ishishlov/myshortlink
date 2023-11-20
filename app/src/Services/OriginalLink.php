<?php

namespace App\Services;

class OriginalLink
{
    private $link = '';
    private $error = '';

    private function __construct($link)
    {
        $this->link = $link;
    }

    public static function create(?string $link): self
    {
        return new self(trim($link));
    }

    public function validation(): void
    {
        if (!$this->link) {
            $this->setError('Необходимо указать ссылку');
        } else {
            $isCorrect = filter_var($this->link, FILTER_VALIDATE_URL);
            if (!$isCorrect) {
                $this->setError('Необходимо указать корректную ссылку');
            }
        }
    }

    public function get(): string
    {
        return $this->link;
    }

    public function getError(): string
    {
        return $this->error;
    }

    private function setError(string $text): void
    {
        $this->error = $text;
    }
}
