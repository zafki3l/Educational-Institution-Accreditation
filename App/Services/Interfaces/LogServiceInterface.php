<?php

namespace App\Services\Interfaces;

use MongoDB\InsertOneResult;

interface LogServiceInterface
{
    public function createLogUser(array $user, string $action, string $message, array $options = []): InsertOneResult;
}