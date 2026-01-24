<?php

namespace App\Business\Modules\Evidence;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Domain\Entities\DataTransferObjects\CommandResult;

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
    public function __construct(private LogServiceInterface $log) {}

    /**
     * @param CommandResult $result
     * @param ActorContextInterface $actor
     * @return void
     */
    public function createLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã thêm thêm minh chứng mới";

        $this->log->createLog(
            $actor,
            'user', 
            $result->data, 
            'create', 
            $message, 
            $result->isSuccess
        );
    }

    /**
     * @param CommandResult $result
     * @param ActorContextInterface $actor
     * @return void
     */
    public function updateLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã cập nhật minh chứng {$result->id}";

        $this->log->createLog(
            $actor,
            'user', 
            $result->data, 
            'update', 
            $message, 
            $result->isSuccess
        );
    }

    /**
     * @param CommandResult $result
     * @param ActorContextInterface $actor
     * @return void
     */
    public function deleteLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã xóa minh chứng {$result->id}";

        $this->log->createLog(
            $actor,
            'user', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }

    /**
     * @param string $milestone_id
     * @param CommandResult $result
     * @param ActorContextInterface $actor
     * @return void
     */
    public function addMilestoneLog(string $milestone_id, CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã thêm mốc đánh giá {$milestone_id} vào minh chứng {$result->id}";

        $this->log->createLog(
            $actor,
            'user', 
            $result->data, 
            'add_milestone', 
            $message, 
            $result->isSuccess
        );
    }
}