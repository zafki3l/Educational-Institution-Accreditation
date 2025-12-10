<?php

namespace App\Services\Implementations;

use App\Repositories\NoSql\Interfaces\LogRepositoryInterface;
use App\Services\Interfaces\LogServiceInterface;
use MongoDB\InsertOneResult;

class LogService implements LogServiceInterface
{
    public function __construct(private LogRepositoryInterface $logRepository) {}

    public function createLogUser(array $user, string $action, string $message, array $options = []): InsertOneResult
    {
        $document = $this->userDocument();
        $document['message'] = $message;
        $document['user'] = $user;
        $document['action'] = $action;

        return $this->logRepository->insertOne($document, $options);
    }

    private function userDocument()
    {
        $document = [
            'actor' => $_SESSION['user'],
            'user' => null,
            'action' => null,
            'message' => null,
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s')
        ];

        return $document;
    }
}