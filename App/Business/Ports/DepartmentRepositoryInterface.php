<?php

namespace App\Business\Ports;

interface DepartmentRepositoryInterface
{
    public function all(): array;
}