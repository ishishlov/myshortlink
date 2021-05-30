<?php

namespace Services;

use DateTimeInterface;

interface Storage
{
    public function getOriginalLink(string $token): ?string;

    public function save(Token $token, OriginalLink $originalLink, DateTimeInterface $dateCreate): bool;
}