<?php

namespace App\Business\Commands;

use App\Business\Ports\StandardRepositoryInterface;
use App\Domain\Entities\Models\Standard;

/**
 * This service handles state-changing operations such as
 * creating, updating, and deleting standards. 
 */
class StandardCommand
{
    public function __construct(private StandardRepositoryInterface $repository) {}

    public function create(Standard $standard): int
    {        
        $created_id = $this->repository->create([
            'id' => $standard->getId(),
            'name' => $standard->getName(),
            'department_id' => $standard->getDepartmentId()
        ]);

        return $created_id;
    }

    public function delete(string $standard_id): int
    {
        $deleted_rows = $this->repository->deleteById($standard_id);

        return $deleted_rows;
    }
}