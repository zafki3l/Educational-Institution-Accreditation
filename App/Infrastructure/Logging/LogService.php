<?php

namespace App\Infrastructure\Logging;

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Infrastructure\UTCDateTime\MongoUTCDateTime;
use App\Persistent\Repositories\NoSql\Implementations\Logging\MongoDbLogRepository;
use MongoDB\InsertOneResult;

/**
 * Service for creating audit logs in MongoDB.
 * Logs user actions with target data, message, and success status.
 */
class LogService implements LogServiceInterface
{
    public function __construct(private MongoDbLogRepository $logRepository) {}

    /**
     * @param ActorContextInterface $actor
     * @param string $target_key
     * @param mixed $target_data
     * @param string $action
     * @param string $message
     * @param bool $isSuccess
     * @param array $options
     * @return InsertOneResult
     */
    public function createLog(ActorContextInterface $actor, string $target_key, mixed $target_data, string $action, string $message, bool $isSuccess, array $options = []): InsertOneResult
    {
        $document = [
            'actor' => $actor,
            $target_key => $target_data,
            'action' => $action,
            'message' => $message,
            'created_at' => MongoUTCDateTime::now(),
            'isSuccess' => $isSuccess
        ];

        return $this->logRepository->insertOne($document, $options);
    }
}