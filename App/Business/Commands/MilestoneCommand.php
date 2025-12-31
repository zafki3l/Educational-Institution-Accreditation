<?php

namespace App\Business\Commands;

use App\Business\Ports\MilestoneRepositoryInterface;
use App\Domain\Entities\Models\Milestone;

class MilestoneCommand
{
    public function __construct(private MilestoneRepositoryInterface $repository) {}

    public function create(Milestone $milestone): string
    {
        $created_id = $this->repository->create([
            'id' => $milestone->getId(),
            'criteria_id' => $milestone->getCriteriaId(),
            'name' => $milestone->getName()
        ]);

        return $created_id;
    }

    public function delete(string $id): int
    {        
        $deleted_rows = $this->repository->deleteById($id);

        return $deleted_rows;
    }
}