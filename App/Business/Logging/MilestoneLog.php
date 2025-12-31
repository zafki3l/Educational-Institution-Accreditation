<?php

namespace App\Business\Logging;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Domain\Entities\DataTransferObjects\CommandResult;

class MilestoneLog
{
    public function __construct(private LogServiceInterface $log) {}

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