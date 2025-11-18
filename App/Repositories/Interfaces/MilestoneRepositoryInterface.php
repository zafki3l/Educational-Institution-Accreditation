<?php

namespace App\Repositories\Interfaces;

use App\Models\Milestone;

interface MilestoneRepositoryInterface
{
    public function getAllMilestones(): array;
    public function filterMilestones(?string $standard_id, ?string $criteria_id): array;
    public function createMilestone(Milestone $milestone): void;
    public function deleteMilestone(string $milestone_id): void;
}