<?php

namespace App\Business\Logging;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Domain\Entities\DataTransferObjects\CommandResult;

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
class UserLog
{
    public function __construct(private LogServiceInterface $logService) {}

    public function createLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã thêm người dùng mới";

        $this->logService->createLog(
            $actor,
            'user', 
            $result->data, 
            'create', 
            $message, 
            $result->isSuccess
        );
    }

    public function updateLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã chỉnh sửa thông tin người dùng {$result->id}";

        $this->logService->createLog(
            $actor,
            'user', 
            $result->data, 
            'update', 
            $message, 
            $result->isSuccess
        );
    }

    public function deleteLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã xóa người dùng {$result->id}";

        $this->logService->createLog(
            $actor,
            'user', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }
}