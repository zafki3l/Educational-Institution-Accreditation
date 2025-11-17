<?php

namespace App\Services\Implementations;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Services\Interfaces\DepartmentServiceInterface;

class DepartmentService implements DepartmentServiceInterface
{
    public function __construct(private Department $department,
                                private DepartmentRepositoryInterface $departmentRepository) {}

    public function findAll(): array
    {
        return $this->departmentRepository->getAllDepartment();
    }
}