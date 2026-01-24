<?php

namespace App\Business\Modules\Milestone;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Domain\Entities\DataTransferObjects\CommandResult;

/**
 * Application service responsible for handling
 * milestone-related audit logging.
 *
 * This service builds contextual log messages and
 * delegates persistence to the generic LogService.
 *
 * It isolates logging concerns from business logic
 * and ensures consistent audit logs for milestone commands.
 */
class MilestoneLog
{
    public function __construct(private LogServiceInterface $log) {}

    /**
     * @param CommandResult $result
     * @param ActorContextInterface $actor
     * @return void
     */
    public function createLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã thêm 1 mốc đánh giá mới";

        $this->log->createLog(
            $actor,
            'milestone', 
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
    public function deleteLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã xóa mốc đánh giá {$result->id}";

        $this->log->createLog(
            $actor,
            'milestone', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }
}