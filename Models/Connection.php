<?php

namespace Models;

use PDO;
use PDOException;

class Connection {

    /** @var PDO */
    protected $db;

    public function __construct(DbConfig $config)
    {
        $this->setInstance($config);
    }

    private function setInstance(DbConfig $config): void
    {
        if (!$this->db) {
            $this->connect($config);
        }
    }

    private function connect(DbConfig $config): void
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
