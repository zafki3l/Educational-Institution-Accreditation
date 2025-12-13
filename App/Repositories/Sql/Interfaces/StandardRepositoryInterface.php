<?php 

namespace App\Repositories\Sql\Interfaces;

use App\Models\Standard;

interface StandardRepositoryInterface
{
    public function all(): array;
    
    public function allWithDepartment(): array;
    
    public function create(array $standard): int;
    
    public function findById(string $standard_id): array;
    
    public function deleteById(string $id): int;

    public function countAll(): int;
}