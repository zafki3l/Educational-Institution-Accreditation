<?php 

namespace App\Repositories\Interfaces;

use App\Models\Standard;

interface StandardRepositoryInterface
{
    public function getAllStandard(): array;
    public function getAllStandardWithDepartment(): array;
    public function createStandard(Standard $standard): void;
    public function deleteStandard(string $id): void;
}