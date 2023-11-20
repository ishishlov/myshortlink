<?php

namespace App\Models;

use DateTimeInterface;
use PDO;
use App\Services\OriginalLink;
use App\Services\Storage;
use App\Services\Token;

class DatabaseLinkStorage extends Connection implements Storage
{
    private const NAME_TABLE = 'short_links';
    private const FIELD_TOKEN = 'token';
    private const FIELD_ORIGINAL_LINK = 'original_link';
    private const FIELD_DATE_CREATE = 'date_create';

    public function getOriginalLink(string $token): ?string
    {
        $query = sprintf(
            'SELECT %s FROM %s WHERE %s = ?;',
            self::FIELD_ORIGINAL_LINK,
            self::NAME_TABLE,
            self::FIELD_TOKEN
        );
        $stmt = $this->db->prepare($query);
        $stmt->execute([$token]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return empty($result[self::FIELD_ORIGINAL_LINK])
            ? null
            : $result[self::FIELD_ORIGINAL_LINK];
    }

    public function save(Token $token, OriginalLink $originalLink, DateTimeInterface $dateCreate, ?int $ttl = 86400): bool
    {
        $query = sprintf(
            'INSERT INTO %s (%s, %s, %s) VALUES (?, ?, ?);',
            self::NAME_TABLE,
            self::FIELD_TOKEN,
            self::FIELD_ORIGINAL_LINK,
            self::FIELD_DATE_CREATE
        );
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$token->get(), $originalLink->get(), $dateCreate->format('Y-m-d')]);
    }
}