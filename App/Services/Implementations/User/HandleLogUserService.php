<?php

namespace App\Services\Implementations\User;

use App\Services\Interfaces\LogServiceInterface;
use App\Services\Interfaces\User\HandleLogUserServiceInterface;
use MongoDB\InsertOneResult;

class HandleLogUserService implements HandleLogUserServiceInterface
{
    public function __construct(private LogServiceInterface $logService) {}

    public function createLog(array $data, bool $isSuccess): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm người dùng mới";

        return $this->logService->createLog('user', $data, 'create', $message, $isSuccess);
    }

    public function updateLog(array $data, bool $isSuccess): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã chỉnh sửa thông tin người dùng {$data['id']}";

        return $this->logService->createLog('user', $data, 'update', $message, $isSuccess);
    }

    public function deleteLog(array $data, bool $isSuccess): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa người dùng {$data['id']}";

        return $this->logService->createLog('user', $data, 'delete', $message, $isSuccess);
    }
}