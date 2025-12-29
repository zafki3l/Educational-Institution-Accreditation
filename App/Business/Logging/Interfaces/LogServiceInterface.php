<?php

namespace App\Business\Logging\Interfaces;

use App\Business\Contexts\ActorContextInterface;
use MongoDB\InsertOneResult;

interface LogServiceInterface
{
    public function createLog(ActorContextInterface $actor, string $target_key, mixed $target_data, string $action, string $message, bool $isSuccess, array $options = []): InsertOneResult;
}