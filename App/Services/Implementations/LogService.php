<?php

namespace App\Services\Implementations;

use App\Repositories\NoSql\Interfaces\LogRepositoryInterface;
use App\Services\Interfaces\LogServiceInterface;
use MongoDB\InsertOneResult;
use Supports\MongoUTCDateTime;

class LogService implements LogServiceInterface
{
    public function __construct(private LogRepositoryInterface $logRepository) {}

    public function createLog(string $target_key, mixed $target_data, string $action, string $message, bool $isSuccess, array $options = []): InsertOneResult
    {
        $document = [
            'actor' => $_SESSION['user'],
            $target_key => $target_data,
            'action' => $action,
            'message' => $message,
            'created_at' => MongoUTCDateTime::now(),
            'isSuccess' => $isSuccess
        ];

        return $this->logRepository->insertOne($document, $options);
    }
}