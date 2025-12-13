<?php

namespace App\Repositories\NoSql\Interfaces;

use MongoDB\InsertOneResult;

interface LogRepositoryInterface
{
    public function findAll();

    public function insertOne(array $document, array $options = []): InsertOneResult;
}