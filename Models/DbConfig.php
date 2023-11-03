<?php

namespace Models;

interface DbConfig
{
    public function getHost(): string;

    public function getPort(): string;

    public function getName(): string;

    public function getLogin(): string;

    public function getPassword(): string;

    public function getDsn(): string;

    public function isDebugMode(): bool;
}