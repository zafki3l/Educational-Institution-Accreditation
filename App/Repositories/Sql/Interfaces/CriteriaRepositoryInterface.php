<?php 

namespace App\Repositories\Sql\Interfaces;

use App\Models\Criteria;

interface CriteriaRepositoryInterface
{
    public function all(): array;
    
    public function allWithDepartment(): array;
    
    public function filter(array $filter): array;
    
    public function findById(string $criteria_id): array;
    
    public function countAll(): int;
    
    public function create(Criteria $criteria): void;
    
    public function deleteById(string $id): void;
    
    public function search(string $search): array;
    
    public function countSearch(string $search): int;  
}
?>