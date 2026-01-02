<?php

namespace App\Business\Facades;

use App\Business\Queries\RoleQuery;

class RoleFacade
{
    public function __construct(private RoleQuery $query) {}

    public function findAll(): array
    {
        return $this->query->findAll();
    }
}
