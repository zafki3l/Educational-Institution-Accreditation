<?php

namespace App\Services\Implementations;

use App\Repositories\NoSql\Interfaces\LogRepositoryInterface;
use App\Services\Interfaces\LogServiceInterface;
use MongoDB\InsertOneResult;

class LogService implements LogServiceInterface
{
    public function __construct(private LogRepositoryInterface $logRepository) {}

    /**
     * Summary of createLog
     * @param string $target_key
     * @param mixed $target_data
     * @param string $action
     * @param string $message
     * @param bool $isSuccess
     * @param array $options
     * @return InsertOneResult
     */
    public function createLog(string $target_key, mixed $target_data, string $action, string $message, bool $isSuccess, array $options = []): InsertOneResult
    {
        $document = [
            'actor' => $_SESSION['user'],
            $target_key => $target_data,
            'action' => $action,
            'message' => $message,
            'created_at' => new \DateTime()->format('Y-m-d H:i:s'),
            'isSuccess' => $isSuccess
        ];

        return $this->logRepository->insertOne($document, $options);
    }
}