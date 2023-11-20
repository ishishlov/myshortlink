<?php

namespace Config;

class Storage extends Common
{
    private $type = '';

    public function __construct()
    {
        $config = parse_ini_file(self::CONFIG_PATH, true);
        $this->type = empty($config['storage']['type']) ? Database::getType() : $config['storage']['type'];
    }

    public function getType(): string
    {
        return $this->type;
    }
}
