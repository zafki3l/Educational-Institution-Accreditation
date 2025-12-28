<?php

namespace App\Services\Implementations\Standard\Command;

use App\Domain\Entities\Models\Standard;
use App\Repositories\Sql\Implementations\Standard\MysqlStandardRepository;

/**
 * This service handles state-changing operations such as
 * creating, updating, and deleting standards. 
 */
class StandardCommand
{
    public function __construct(private MysqlStandardRepository $repository) {}

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