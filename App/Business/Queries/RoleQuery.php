<?php

namespace App\Business\Queries;

use App\Business\Ports\RoleRepositoryInterface;

class RoleQuery
{
    public function __construct(private RoleRepositoryInterface $repository) {}

    public function findAll(): array
    {
        return $this->repository->all();
    }
}