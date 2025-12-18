<?php

namespace App\Services\Interfaces\User;

use MongoDB\InsertOneResult;

interface HandleLogUserServiceInterface
{
    public function createLog(array $created): InsertOneResult;

    public function updateLog(array $updated): InsertOneResult;

    public function deleteLog(array $deleted): InsertOneResult;
}