<?php

namespace App\Repositories\Interfaces;

use App\Models\Milestone;

interface MilestoneRepositoryInterface
{
    public function all(): array;
    public function filter(array $filter): array;
    public function findById(string $milestone_id): array;
    public function create(Milestone $milestone): void;
    public function deleteById(string $milestone_id): void;
}