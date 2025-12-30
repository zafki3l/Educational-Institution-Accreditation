<?php

namespace App\Business\Ports;

interface RoleRepositoryInterface
{
    public function all(): array;
}