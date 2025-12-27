<?php

namespace App\Services\Implementations\Logging;

use App\Repositories\NoSql\Implementations\Logging\MongoDbLogRepository;
use MongoDB\InsertOneResult;
use Supports\MongoUTCDateTime;

/**
 * Service for creating audit logs in MongoDB.
 * Logs user actions with target data, message, and success status.
 */
class LogService
{
    public function __construct(private MongoDbLogRepository $logRepository) {}

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