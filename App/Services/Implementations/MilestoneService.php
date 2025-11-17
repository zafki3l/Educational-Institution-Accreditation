<?php

namespace App\Services\Implementations;

use App\Models\Milestone;
use App\Repositories\Interfaces\MilestoneRepositoryInterface;
use App\Services\Interfaces\MilestoneServiceInterface;

class MilestoneService implements MilestoneServiceInterface
{
    public function __construct(private Milestone $milestone,
                                private MilestoneRepositoryInterface $milestoneRepository) {}

    public function listMilestone(?string $search, string $criteria_id): array
    {
        $milestones = $search ? $this->find($search) 
                            : $this->findByCriteria($criteria_id);

        return $milestones;
    }

    public function findByCriteria(string $criteria_id): array
    {
        return $this->milestoneRepository->getMilestonesByCriteria($criteria_id);
    }

    public function createMilestone(array $request): void
    {
        $this->milestone->setId($request['id'])
                        ->setCriteriaId($request['criteria_id'])
                        ->setName($request['name']);
        
        $this->milestoneRepository->createMilestone($this->milestone);
    }

    public function deleteMilestone(string $milestone_id): void
    {
        $this->milestoneRepository->deleteMilestone($milestone_id);
    }

    public function findAll(): array
    {
        return [];
    }

    public function find(?string $search): array
    {
        return [];
    }
}