<?php 

namespace App\Repositories\Sql\Interfaces;

use App\Models\Standard;

interface StandardRepositoryInterface
{
    public function all(): array;
    
    public function allWithDepartment(): array;
    
    public function create(Standard $standard): void;
    
    public function findById(string $standard_id): array;
    
    public function deleteById(string $id): void;

    public function countAll(): int;
}