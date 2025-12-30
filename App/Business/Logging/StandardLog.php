<?php

namespace App\Business\Logging;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Domain\Entities\DataTransferObjects\CommandResult;

/**
 * Application service responsible for handling
 * standard-related audit logging.
 *
 * This service builds contextual log messages and
 * delegates persistence to the generic LogService.
 *
 * It isolates logging concerns from business logic
 * and ensures consistent audit logs for standard commands.
 */
class StandardLog
{
    public function __construct(private LogServiceInterface $log) {}

    public function createLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã thêm 1 tiêu chuẩn mới";

        $this->log->createLog(
            $actor,
            'standard', 
            $result->data, 
            'create', 
            $message, 
            $result->isSuccess
        );
    }

    public function deleteLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã xóa tiêu chuẩn {$result->id}";

        $this->log->createLog(
            $actor,
            'standard', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }
}