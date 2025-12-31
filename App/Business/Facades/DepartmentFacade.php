<?php

namespace App\Business\Facades;

use App\Business\Queries\DepartmentQuery;

class DepartmentFacade
{
    public function __construct(private DepartmentQuery $query) {}

    public function findAll(): array
    {
        return $this->query->findAll();
    }
}