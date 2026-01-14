<?php

namespace App\Business\Ports;

interface CriteriaRepositoryInterface
{
    public function all(): array;

    public function allWithDepartment(): array;
    
    public function criteriaByStandard(): array;

    public function findById(string $criteria_id): array;

    public function filter(array $filter): array;

    public function countAll(): int;

    public function create(array $criteria): int;

    public function deleteById(string $id): int;

    public function search(string $search): array;

    public function countSearch(string $search): int;
}