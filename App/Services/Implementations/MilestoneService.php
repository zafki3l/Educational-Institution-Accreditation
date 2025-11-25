<?php

namespace App\Services\Implementations;

use App\Exceptions\MilestoneException\MilestoneNotFoundException;
use App\Models\Milestone;
use App\Repositories\Interfaces\MilestoneRepositoryInterface;
use App\Services\Interfaces\MilestoneServiceInterface;

class MilestoneService implements MilestoneServiceInterface
{
    public function __construct(private MilestoneRepositoryInterface $milestoneRepository) {}

    public function list(?string $search, array $filter): array
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

    public function filter(array $filter): array
    {
        return $this->milestoneRepository->filter($filter);
    }

    public function findAll(): array
    {
        return $this->milestoneRepository->all();
    }

    public function find(?string $search): array
    {
        // TODO:
        return [];
    }

    public function create(array $request): void
    {
        $milestone = new Milestone();

        $milestone->setId($request['id'])
                    ->setCriteriaId($request['criteria_id'])
                    ->setName($request['name']);
    
        $this->milestoneRepository->create($milestone);
    }

    public function delete(string $milestone_id): void
    {
        $this->findOrFail($milestone_id);
        
        $this->milestoneRepository->deleteById($milestone_id);
    }

    private function findOrFail(string $milestone_id): void
    {
        $found = $this->milestoneRepository->findById($milestone_id);

        if (!$found) {
            throw new MilestoneNotFoundException($milestone_id);
        }
    }

    private function filterArray(array $filter)
    {
        return array_filter($filter, function ($value) {
            return !empty($value);
        });
    }
}