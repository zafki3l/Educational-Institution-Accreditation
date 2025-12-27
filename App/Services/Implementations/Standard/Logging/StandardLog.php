<?php

namespace App\Services\Implementations\Standard\Logging;

use App\Entities\DataTransferObjects\CommandResult;
use App\Services\Implementations\Logging\LogService;
use MongoDB\InsertOneResult;

class StandardLog
{
    public function __construct(private LogService $log) {}

    public function createLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm 1 tiêu chuẩn mới";

        return $this->log->createLog(
            'standard', 
            $result->data, 
            'create', 
            $message, 
            $result->isSuccess
        );
    }

    public function deleteLog(CommandResult $result): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa tiêu chuẩn {$result->id}";

        return $this->log->createLog(
            'standard', 
            $result->data, 
            'delete', 
            $message, 
            $result->isSuccess
        );
    }
}