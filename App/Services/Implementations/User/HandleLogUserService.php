<?php

namespace App\Services\Implementations\User;

use App\Services\Interfaces\LogServiceInterface;
use App\Services\Interfaces\User\HandleLogUserServiceInterface;
use MongoDB\InsertOneResult;

class HandleLogUserService implements HandleLogUserServiceInterface
{
    public function __construct(private LogServiceInterface $logService) {}

    public function createLog(array $created): InsertOneResult
    {
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm người dùng mới";

        return $this->logService->createLog('user', $created['data'], 'create', $message, $created['isSuccess']);
    }

    public function updateLog(array $updated): InsertOneResult
    {
        $data = $updated['data'];

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã chỉnh sửa thông tin người dùng {$data['id']}";

        return $this->logService->createLog('user', $data, 'update', $message, $updated['isSuccess']);
    }

    public function deleteLog(array $deleted): InsertOneResult
    {
        $data = $deleted['data'];

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa người dùng {$data['id']}";

        return $this->logService->createLog('user', $data, 'delete', $message, $deleted['isSuccess']);
    }
}