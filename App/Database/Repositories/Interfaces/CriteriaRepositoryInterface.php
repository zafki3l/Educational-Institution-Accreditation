<?php 
namespace App\Database\Repositories\Interfaces;

use App\Database\Models\Criteria;

interface CriteriaRepositoryInterface
{
    public function getAllCriteria(): array;
    public function countAllCriteria(): int;
    public function createCriteria(Criteria $criteria): void;
    public function deleteCriteria(string $id): void;
    public function searchCriteria(string $search): array;
    public function countSearchCriteria(string $search): int;  
}
?>