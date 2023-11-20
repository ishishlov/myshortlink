<?php

namespace App\Models;

use DateTimeInterface;
use App\Services\OriginalLink;
use App\Services\Storage;
use App\Services\Token;

class RedisLinkStorage extends RedisStorage implements Storage
{
    private const FIELD_TOKEN = 'token';
    private const FIELD_ORIGINAL_LINK = 'original_link';
    private const FIELD_DATE_CREATE = 'date_create';

    public function getOriginalLink(string $token): ?string
    {
        $link = $this->get($token);

        return empty($link[self::FIELD_ORIGINAL_LINK]) ? null : $link[self::FIELD_ORIGINAL_LINK];
    }

    public function save(Token $token, OriginalLink $originalLink, DateTimeInterface $dateCreate, ?int $ttl = 86400): bool
    {
        $this->set(
            $token->get(),
            [
                self::FIELD_TOKEN => $token->get(),
                self::FIELD_ORIGINAL_LINK => $originalLink->get(),
                self::FIELD_DATE_CREATE => $dateCreate->format('Y-m-d'),
            ],
            $ttl
        );
        return true;
    }
}
