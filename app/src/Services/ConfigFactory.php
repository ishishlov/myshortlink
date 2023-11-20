<?php

namespace App\Services;

use App\Models\StorageConfig;
use Config\Database;
use Config\Redis;
use Exception;

class ConfigFactory
{
    public static function create(string $type): StorageConfig
    {
        return match($type) {
            Database::getType() => new Database(),
            Redis::getType() => new Redis(),
            default => throw new Exception('Некорректный тип хранилища'),
        };
    }
}
