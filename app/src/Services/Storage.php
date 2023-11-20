<?php

namespace App\Services;

use DateTimeInterface;

interface Storage
{
    public function getOriginalLink(string $token): ?string;

    public function save(Token $token, OriginalLink $originalLink, DateTimeInterface $dateCreate, ?int $ttl = 86400): bool;
}