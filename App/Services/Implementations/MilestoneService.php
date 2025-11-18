<?php

namespace App\Services\Implementations;

use App\Models\Milestone;
use App\Repositories\Interfaces\MilestoneRepositoryInterface;
use App\Services\Interfaces\MilestoneServiceInterface;

class MilestoneService implements MilestoneServiceInterface
{
    public function __construct(private Milestone $milestone,
                                private MilestoneRepositoryInterface $milestoneRepository) {}

    public function listMilestones(?string $search, ?string $standard_id, ?string $criteria_id): array
    {
        if ($search) return $this->find($search);

        if ($standard_id && $criteria_id) return $this->filterMilestones($standard_id, $criteria_id);

        return $this->findAll();
    }

    public function filterMilestones(?string $standard_id, ?string $criteria_id): array
    {
        return $this->milestoneRepository->filterMilestones($standard_id, $criteria_id);
    }

    public function findAll(): array
    {
        return $this->milestoneRepository->getAllMilestones();
    }

    public function find(?string $search): array
    {
        // TODO:
        return [];
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
}