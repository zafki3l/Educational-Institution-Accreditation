<?php

namespace App\Services\Implementations\Role;

use App\Persistent\Repositories\Sql\Implementations\Role\MySqlRoleRepository;

class RoleService
{
    public function __construct(private MySqlRoleRepository $roleRepository) {}

    public function findAll(): array
    {
        return $this->roleRepository->all();
    }
}