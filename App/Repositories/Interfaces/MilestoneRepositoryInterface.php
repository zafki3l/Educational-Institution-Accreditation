<?php

namespace App\Repositories\Interfaces;

use App\Models\Milestone;

interface MilestoneRepositoryInterface
{
    public function getAllMilestones(): array;
    public function filterMilestones(array $filter): array;
    public function createMilestone(Milestone $milestone): void;
    public function deleteMilestone(string $milestone_id): void;
}