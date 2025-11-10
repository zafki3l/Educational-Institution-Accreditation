<?php

namespace App\Services;

use App\Database\Models\Department;
use App\Database\Repositories\DepartmentRepository;

class DepartmentService
{
    public function __construct(private Department $department,
                                private DepartmentRepository $departmentRepository) {}

    public function findAll(): array
    {
        return $this->departmentRepository->getAllDepartment();
    }
}