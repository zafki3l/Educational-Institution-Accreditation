<?php

namespace App\Services\Interfaces\User;

use MongoDB\InsertOneResult;

interface HandleLogUserServiceInterface
{
    public function createLog(array $data, bool $isSuccess): InsertOneResult;

    public function updateLog(array $data, bool $isSuccess): InsertOneResult;

    public function deleteLog(array $data, bool $isSuccess): InsertOneResult;
}