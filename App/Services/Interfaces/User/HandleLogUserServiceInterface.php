<?php

namespace App\Services\Interfaces\User;

use App\Entities\DataTransferObjects\CommandResult;
use MongoDB\InsertOneResult;

/**
 * Application service responsible for handling
 * user-related audit logging.
 *
 * This service builds contextual log messages and
 * delegates persistence to the generic LogService.
 *
 * It isolates logging concerns from business logic
 * and ensures consistent audit logs for user commands.
 */
interface HandleLogUserServiceInterface
{
    public function createLog(CommandResult $result): InsertOneResult;

    public function updateLog(CommandResult $result): InsertOneResult;

    public function deleteLog(CommandResult $result): InsertOneResult;
}