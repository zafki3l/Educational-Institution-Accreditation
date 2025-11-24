<?php 

namespace App\Repositories\Interfaces;

use App\Models\Criteria;

interface CriteriaRepositoryInterface
{
    public function getAllCriteria(): array;
    public function getAllCriteriaWithDepartment(): array;
    public function getCriteriasByStandard(array $filter): array;
    public function countAllCriteria(): int;
    public function createCriteria(Criteria $criteria): void;
    public function deleteCriteria(string $id): void;
    public function searchCriteria(string $search): array;
    public function countSearchCriteria(string $search): int;  
}
?>