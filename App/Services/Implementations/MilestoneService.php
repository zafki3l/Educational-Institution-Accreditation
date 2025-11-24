<?php

namespace App\Services\Implementations;

use App\Models\Milestone;
use App\Repositories\Interfaces\MilestoneRepositoryInterface;
use App\Services\Interfaces\MilestoneServiceInterface;

class MilestoneService implements MilestoneServiceInterface
{
    public function __construct(private Milestone $milestone,
                                private MilestoneRepositoryInterface $milestoneRepository) {}

    public function listMilestones(?string $search, array $filter): array
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filterMilestones($filter);

        return $this->findAll();
    }

    public function filterMilestones(array $filter): array
    {
        return $this->milestoneRepository->filterMilestones($filter);
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

    private function filterArray(array $filter)
    {
        return array_filter($filter, function ($value) {
            return !empty($value);
        });
    }
}