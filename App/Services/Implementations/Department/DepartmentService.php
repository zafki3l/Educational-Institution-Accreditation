<?php

namespace App\Services\Implementations\Department;

use App\Repositories\Sql\Implementations\Department\MySqlDepartmentRepository;

class DepartmentService
{
    public function __construct(private MySqlDepartmentRepository $departmentRepository) {}

    public function findAll(): array
    {
        return $this->departmentRepository->all();
    }
}