<?php

namespace App\Services\Interfaces;

interface MilestoneServiceInterface
{
    public function listMilestone(?string $search, string $criteria_id): array;
    public function findByCriteria(string $criteria_id): array;
    public function createMilestone(array $request): void;
    public function deleteMilestone(string $milestone_id): void;
    public function findAll(): array;
    public function find(?string $search): array;
}