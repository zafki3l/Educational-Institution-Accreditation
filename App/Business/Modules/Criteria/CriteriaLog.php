<?php

namespace App\Business\Modules\Criteria;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Domain\Entities\DataTransferObjects\CommandResult;

/**
 * Application service responsible for handling
 * criteria-related audit logging.
 *
 * This service builds contextual log messages and
 * delegates persistence to the generic LogService.
 *
 * It isolates logging concerns from business logic
 * and ensures consistent audit logs for criteria commands.
 */
class CriteriaLog
{
    public function __construct(private LogServiceInterface $log) {}

    /**
     * @param CommandResult $result
     * @param ActorContextInterface $actor
     * @return void
     */
    public function createLog(CommandResult $result, ActorContextInterface $actor): void
    {
        $message = "Người dùng {$actor->fullName()} đã thêm 1 tiêu chí mới";

        $this->log->createLog(
            $actor,
            'criteria', 
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
        $message = "Người dùng {$actor->fullName()} đã xóa tiêu chí {$result->id}";

        $this->log->createLog(
            $actor,
            'criteria', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }
}