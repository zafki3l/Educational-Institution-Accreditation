<?php

namespace App\Services\Interfaces;

use MongoDB\InsertOneResult;

interface LogServiceInterface
{
    public function createLog(string $target_key, mixed $target_data, string $action, string $message, bool $isSuccess, array $options = []): InsertOneResult;
}