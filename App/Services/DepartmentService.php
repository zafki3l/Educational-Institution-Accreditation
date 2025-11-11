<?php

namespace App\Services;

use App\Database\Models\Department;
use App\Database\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentService
{
    public function __construct(private Department $department,
                                private DepartmentRepositoryInterface $departmentRepository) {}

    public function findAll(): array
    {
        return $this->departmentRepository->getAllDepartment();
    }
}