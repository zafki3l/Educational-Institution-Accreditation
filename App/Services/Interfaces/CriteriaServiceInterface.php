<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Criteria\CreateCriteriaRequest;

interface CriteriaServiceInterface
{
    public function list(?string $search, array $filter): array;

    public function create(CreateCriteriaRequest $request): void;

    public function delete(string $id): void;

    public function filter(array $filter): array;

    public function findAll(): array;
    
    public function find(?string $search): array;

    public function count(): int;
}