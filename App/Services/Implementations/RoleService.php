<?php

namespace App\Services\Implementations;

use App\Repositories\Sql\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface
{
    public function __construct(private RoleRepositoryInterface $roleRepository) {}

    public function findAll(): array
    {
        return $this->roleRepository->all();
    }
}