<?php 

namespace App\Database\Repositories\Interfaces;

use App\Database\Models\Standard;

interface StandardRepositoryInterface
{
    public function getAllStandard(): array;
    public function createStandard(Standard $standard): void;
    public function deleteStandard(string $id): void;
}