<?php

namespace Services;

class Token
{
    private const AVAILABLE_SYMBOLS = [
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
		'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
		'1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
	];
    private const TOKEN_SIZE = 6;

    private $token = '';

    private function __construct($token)
    {
        $this->token = $token;
    }

    public static function generate(): self
    {
        $token = '';
        for ($i = 0; $i < self::TOKEN_SIZE; $i++) {
            $token .= self::AVAILABLE_SYMBOLS[random_int(0, count(self::AVAILABLE_SYMBOLS) - 1)];
        }

        return new self($token);
    }

    public function get(): string
    {
        return $this->token;
    }
}
