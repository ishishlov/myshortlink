<?php

namespace App\Models;

interface StorageConfig
{
    public function getHost(): string;

    public function getPort(): string;

    public function getName(): string;

    public function getLogin(): string;

    public function getPassword(): string;

    public function getDsn(): string;

    public function isDebugMode(): bool;

    public static function getType(): string;
}