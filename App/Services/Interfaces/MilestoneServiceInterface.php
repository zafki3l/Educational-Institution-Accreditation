<?php

namespace App\Services\Interfaces;

interface MilestoneServiceInterface
{
    public function listMilestones(?string $search, ?string $standard_id, ?string $criteria_id): array;
    public function filterMilestones(?string $standard_id, ?string $criteria_id): array;
    public function createMilestone(array $request): void;
    public function deleteMilestone(string $milestone_id): void;
    public function findAll(): array;
    public function find(?string $search): array;
}