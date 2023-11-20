<?php

namespace Config;

use App\Models\StorageConfig;

class Redis extends Common implements StorageConfig
{
    private const TYPE = 'redis';

    private $host = '';
    private $port = '';

    public function __construct()
    {
        $config = parse_ini_file(self::CONFIG_PATH, true);
        $this->host = empty($config['redis']['host']) ? $this->host : $config['redis']['host'];
        $this->port = empty($config['redis']['port']) ? '6379' : $config['redis']['port'];
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function getName(): string
    {
        return '';
    }

    public function getLogin(): string
    {
        return '';
    }

    public function getPassword(): string
    {
        return '';
    }

    public function getDsn(): string
    {
        return '';
    }

    public function isDebugMode(): bool
    {
        return false;
    }

    public static function getType(): string
    {
        return self::TYPE;
    }
}
