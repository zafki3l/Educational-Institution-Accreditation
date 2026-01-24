<?php

namespace App\Business\Modules\Milestone;

use App\Business\Ports\MilestoneRepositoryInterface;
use App\Domain\Entities\Models\Milestone;

/**
 * This is the "Writer" service. It isolates all operations that change 
 * the database state. Keeping writes separate from reads makes the code cleaner
 * and more "Seperation of Concerns"
 */
class MilestoneCommand
{
    public function __construct(private MilestoneRepositoryInterface $repository) {}

    /**
     * @param Milestone $milestone
     * @return string
     */
    public function create(Milestone $milestone): string
    {
        $created_id = $this->repository->create([
            'id' => $milestone->getId(),
            'criteria_id' => $milestone->getCriteriaId(),
            'name' => $milestone->getName()
        ]);

        return $created_id;
    }

    /**
     * @param string $id
     * @return int
     */
    public function delete(string $id): int
    {        
        $deleted_rows = $this->repository->deleteById($id);

        return $deleted_rows;
    }
}