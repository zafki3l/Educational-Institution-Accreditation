<?php

namespace App\Business\Queries;

use App\Business\Ports\DepartmentRepositoryInterface;

class DepartmentQuery
{
    public function __construct(private DepartmentRepositoryInterface $repository) {}

    public function findAll(): array
    {
        return $this->repository->all();
    }
}