<?php

namespace App\Business\Logging;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Domain\Entities\DataTransferObjects\CommandResult;

class CriteriaLog
{
    public function __construct(private LogServiceInterface $log) {}

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