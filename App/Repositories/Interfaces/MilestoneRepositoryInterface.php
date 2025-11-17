<?php

namespace App\Repositories\Interfaces;

use App\Models\Milestone;

interface MilestoneRepositoryInterface
{
    public function getMilestonesByCriteria(string $criteria_id): array;
    public function createMilestone(Milestone $milestone): void;
    public function deleteMilestone(string $milestone_id): void;
}