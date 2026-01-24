<?php

namespace App\Business\Modules\Standard;

use App\Business\Ports\StandardRepositoryInterface;
use App\Domain\Entities\Models\Standard;

/**
 * This is the "Writer" service. It isolates all operations that change 
 * the database state. Keeping writes separate from reads makes the code cleaner
 * and more "Seperation of Concerns"
 */
class StandardCommand
{
    public function __construct(private StandardRepositoryInterface $repository) {}

    /**
     * @param Standard $standard
     * @return int
     */
    public function create(Standard $standard): int
    {        
        $created_id = $this->repository->create([
            'id' => $standard->getId(),
            'name' => $standard->getName(),
            'department_id' => $standard->getDepartmentId()
        ]);

        return $created_id;
    }

    /**
     * @param string $standard_id
     * @return int
     */
    public function delete(string $standard_id): int
    {
        $deleted_rows = $this->repository->deleteById($standard_id);

        return $deleted_rows;
    }
}