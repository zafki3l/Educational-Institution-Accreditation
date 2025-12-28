<?php

namespace App\Services\Implementations\User\Logging;

use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Services\Implementations\Logging\LogService;
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
class UserLog
{
    public function __construct(private LogService $logService) {}

    public function createLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm người dùng mới";

        return $this->logService->createLog(
            'user', 
            $result->data, 
            'create', 
            $message, 
            $result->isSuccess
        );
    }

    public function updateLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã chỉnh sửa thông tin người dùng {$result->id}";

        return $this->logService->createLog(
            'user', 
            $result->data, 
            'update', 
            $message, 
            $result->isSuccess
        );
    }

    public function deleteLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa người dùng {$result->id}";

        return $this->logService->createLog(
            'user', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }
}