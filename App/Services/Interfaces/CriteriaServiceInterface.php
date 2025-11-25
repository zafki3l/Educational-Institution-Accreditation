<?php

namespace App\Services\Interfaces;

interface CriteriaServiceInterface
{
    public function list(?string $search, array $filter): array;
    public function create(array $request): void;
    public function delete(string $id): void;
    public function filter(array $filter): array;
    public function findAll(): array;
    public function find(?string $search): array;
}