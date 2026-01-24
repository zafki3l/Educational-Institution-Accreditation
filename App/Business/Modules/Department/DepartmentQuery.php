<?php

namespace App\Business\Modules\Department;

use App\Business\Ports\DepartmentRepositoryInterface;

class DepartmentQuery
{
    public function __construct(private DepartmentRepositoryInterface $repository) {}

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->repository->all();
    }
}