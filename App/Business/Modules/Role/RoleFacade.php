<?php

namespace App\Business\Modules\Role;

class RoleFacade
{
    public function __construct(private RoleQuery $query) {}

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->query->findAll();
    }
}
