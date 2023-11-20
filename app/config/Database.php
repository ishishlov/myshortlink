<?php

namespace Config;

use App\Models\DbConfig;

class Database implements DbConfig
{
    const CONFIG_PATH = __DIR__ . '/../../config.ini';
    const DEBUG_MODE = true;

    private $host = '';
    private $port = '';
    private $name = '';
    private $login = '';
    private $password = '';

    public function __construct()
    {
        $config = parse_ini_file(self::CONFIG_PATH, true);
        $this->host = empty($config['SQL']['host']) ? $this->host : $config['SQL']['host'];
        $this->port = empty($config['SQL']['port']) ? $this->port : $config['SQL']['port'];
        $this->name = empty($config['SQL']['name']) ? $this->name : $config['SQL']['name'];
        $this->login = empty($config['SQL']['login']) ? $this->login : $config['SQL']['login'];
        $this->password = empty($config['SQL']['password']) ? $this->password : $config['SQL']['password'];
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
}
