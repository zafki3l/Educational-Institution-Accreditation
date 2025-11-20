<?php

namespace App\Services\Implementations;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface
{
    public function __construct(private Role $role,
                                private RoleRepositoryInterface $roleRepository) {}

    public function findAll(): array
    {
        return $this->roleRepository->getAllRoles();
    }
}