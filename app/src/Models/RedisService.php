<?php

namespace App\Models;

use Predis\Client;
use Predis\Response\Status;

class RedisService
{
    protected Client $client;

    public function __construct(StorageConfig $config)
    {
        $this->client = new Client([
            'host' => $config->getHost(),
            'port' => $config->getPort(),
            'scheme' => 'tcp',
        ]);
    }

    protected function set(string $key, array $value, int $ttl): Status
    {
        return $this->client->setex($key, $ttl, json_encode($value));
    }

    protected function exists($key): bool
    {
        return $this->client->exists($key) > 0;
    }

    protected function get($key): ?array
    {
        return $this->exists($key) ? json_decode($this->client->get($key), true) : null;
    }

    public function __destruct()
    {
        $this->client->quit();
    }
}
