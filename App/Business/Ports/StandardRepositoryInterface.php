<?php

namespace App\Business\Ports;

interface StandardRepositoryInterface
{
    public function all(): array;

    public function allWithDepartment(): array;

    public function create(array $standard): int;

    public function findById(string $standard_id): array;

    public function deleteById(string $standard_id): int;

    public function countAll(): int;
}