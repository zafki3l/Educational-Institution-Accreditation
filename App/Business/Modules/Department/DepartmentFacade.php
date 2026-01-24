<?php

namespace App\Business\Modules\Department;

class DepartmentFacade
{
    public function __construct(private DepartmentQuery $query) {}

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->query->findAll();
    }
}
