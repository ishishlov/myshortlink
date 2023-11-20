<?php

namespace Config;

use App\Models\StorageConfig;

class Database extends Common implements StorageConfig
{
    private const TYPE = 'mysql';
    private const DEBUG_MODE = true;

    private $host = '';
    private $port = '';
    private $name = '';
    private $login = '';
    private $password = '';

    public function __construct()
    {
        $config = parse_ini_file(self::CONFIG_PATH, true);
        $this->host = empty($config['sql']['host']) ? $this->host : $config['sql']['host'];
        $this->port = empty($config['sql']['port']) ? $this->port : $config['sql']['port'];
        $this->name = empty($config['sql']['name']) ? $this->name : $config['sql']['name'];
        $this->login = empty($config['sql']['login']) ? $this->login : $config['sql']['login'];
        $this->password = empty($config['sql']['password']) ? $this->password : $config['sql']['password'];
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
        return $this->name;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDsn(): string
    {
        return 'mysql:dbname=' . $this->name . ';host=' . $this->host . $this->port;
    }

    public function isDebugMode(): bool
    {
        return self::DEBUG_MODE;
    }

    public static function getType(): string
    {
        return self::TYPE;
    }
}
