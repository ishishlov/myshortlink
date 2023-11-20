<?php

namespace App\Models;

use PDO;
use PDOException;

class Connection {

    /** @var PDO */
    protected $db;

    public function __construct(StorageConfig $config)
    {
        $this->setInstance($config);
    }

    private function setInstance(StorageConfig $config): void
    {
        if (!$this->db) {
            $this->connect($config);
        }
    }

    private function connect(StorageConfig $config): void
    {
        $debug = $config->isDebugMode() ? [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] : [];
        try {
            $this->db = new PDO(
                $config->getDsn(),
                $config->getLogin(),
                $config->getPassword(),
                $debug
            );
            $this->db->query("SET NAMES 'utf8'");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
