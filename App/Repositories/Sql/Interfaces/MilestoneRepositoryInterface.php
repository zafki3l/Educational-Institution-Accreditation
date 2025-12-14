<?php

namespace App\Repositories\Sql\Interfaces;

use App\Models\Milestone;

interface MilestoneRepositoryInterface
{
    public function all(): array;
    
    public function filter(array $filter): array;
    
    public function findById(string $milestone_id): array;
    
    public function create(array $milestone): string;
    
    public function deleteById(string $milestone_id): int;

    public function countAll(): int;
}