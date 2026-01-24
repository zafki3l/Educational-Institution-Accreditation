<?php

namespace App\Business\Modules\Criteria;

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Domain\Entities\Models\Criteria;

/**
 * This is the "Writer" service. It isolates all operations that change 
 * the database state. Keeping writes separate from reads makes the code cleaner
 * and more "Seperation of Concerns"
 */
class CriteriaCommand
{
    public function __construct(private CriteriaRepositoryInterface $repository) {}

    /**
     * @param Criteria $criteria
     * @return int
     */
    public function create(Criteria $criteria): int
    {
        $created_id = $this->repository->create([
            'id' => $criteria->getId(),
            'standard_id' => $criteria->getStandardId(),
            'name' => $criteria->getName()
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