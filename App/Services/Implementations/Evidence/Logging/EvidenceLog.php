<?php

namespace App\Services\Implementations\Evidence\Logging;

use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Services\Implementations\Logging\LogService;
use MongoDB\InsertOneResult;

/**
 * Application service responsible for handling
 * evidence-related audit logging.
 *
 * This service builds contextual log messages and
 * delegates persistence to the generic LogService.
 *
 * It isolates logging concerns from business logic
 * and ensures consistent audit logs for evidence commands.
 */
class EvidenceLog
{
    public function __construct(private LogService $log) {}

    public function createLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm thêm minh chứng mới";

        return $this->log->createLog(
            'user', 
            $result->data, 
            'create', 
            $message, 
            $result->isSuccess
        );
    }

    public function updateLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã cập nhật minh chứng {$result->id}";

        return $this->log->createLog(
            'user', 
            $result->data, 
            'update', 
            $message, 
            $result->isSuccess
        );
    }

    public function deleteLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa minh chứng {$result->id}";

        return $this->log->createLog(
            'user', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }

    public function addMilestoneLog(string $milestone_id, CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm mốc đánh giá {$milestone_id} vào minh chứng {$result->id}";

        return $this->log->createLog(
            'user', 
            $result->data, 
            'add_milestone', 
            $message, 
            $result->isSuccess
        );
    }
}