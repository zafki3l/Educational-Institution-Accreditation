<?php

namespace App\Services\Interfaces;

interface MilestoneServiceInterface
{
    public function listMilestones(?string $search, array $filter): array;
    public function filterMilestones(array $filter): array;
    public function createMilestone(array $request): void;
    public function deleteMilestone(string $milestone_id): void;
    public function findAll(): array;
    public function find(?string $search): array;
}