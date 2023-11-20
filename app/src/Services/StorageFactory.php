<?php

namespace App\Services;

use App\Models\DatabaseLinkStorage;
use App\Models\RedisLinkStorage;
use App\Models\StorageConfig;
use Config\Database;
use Config\Redis;
use Exception;

class StorageFactory
{
    public static function create(string $type, StorageConfig $storageConfig): Storage
    {
        return match($type) {
            Database::getType() => new DatabaseLinkStorage($storageConfig),
            Redis::getType() => new RedisLinkStorage($storageConfig),
            default => throw new Exception('Некорректный тип хранилища'),
        };
    }
}
