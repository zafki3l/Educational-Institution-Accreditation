<?php

namespace App\Business\Modules\Role;

use App\Business\Ports\RoleRepositoryInterface;

class RoleQuery
{
    public function __construct(private RoleRepositoryInterface $repository) {}

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->repository->all();
    }
}