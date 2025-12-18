<?php

namespace App\Services\Implementations\User;

use App\DTO\CommandResult;
use App\Services\Interfaces\LogServiceInterface;
use App\Services\Interfaces\User\HandleLogUserServiceInterface;
use MongoDB\InsertOneResult;

class HandleLogUserService implements HandleLogUserServiceInterface
{
    public function __construct(private LogServiceInterface $logService) {}

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