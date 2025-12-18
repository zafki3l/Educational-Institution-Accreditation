<?php

namespace App\Services\Interfaces\User;

use App\DTO\CommandResult;
use MongoDB\InsertOneResult;

interface HandleLogUserServiceInterface
{
    public function createLog(CommandResult $result): InsertOneResult;

    public function updateLog(CommandResult $result): InsertOneResult;

    public function deleteLog(CommandResult $result): InsertOneResult;
}