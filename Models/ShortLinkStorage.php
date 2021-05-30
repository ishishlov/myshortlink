<?php

namespace Models;

require_once 'Models\Connection.php';
require_once 'Services\OriginalLink.php';
require_once 'Services\Token.php';

use DateTimeInterface;
use PDO;
use Services\OriginalLink;
use Services\Storage;
use Services\Token;

class ShortLinkStorage extends Connection implements Storage
{
    private const NAME_TABLE = 'short_links';
    private const FIELD_TOKEN = 'token';
    private const FIELD_ORIGINAL_LINK = 'original_link';
    private const FIELD_DATE_CREATE = 'date_create';

    /** @var PDO|null */
    protected $db = null;

    public function __construct()
    {
        $this->db = (new Connection())->getInstance();
    }

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

    public function save(Token $token, OriginalLink $originalLink, DateTimeInterface $dateCreate): bool
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