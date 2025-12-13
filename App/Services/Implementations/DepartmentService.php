<?php

namespace App\Services\Implementations;

use App\Repositories\Sql\Interfaces\DepartmentRepositoryInterface;
use App\Services\Interfaces\DepartmentServiceInterface;

class DepartmentService implements DepartmentServiceInterface
{
    public function __construct(private DepartmentRepositoryInterface $departmentRepository) {}

    public function findAll(): array
    {
        return $this->departmentRepository->all();
    }
}