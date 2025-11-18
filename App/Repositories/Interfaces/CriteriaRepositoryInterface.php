<?php 

namespace App\Repositories\Interfaces;

use App\Models\Criteria;

interface CriteriaRepositoryInterface
{
    public function getAllCriteria(): array;
    public function getCriteriasByStandard(?string $standard_id): array;
    public function countAllCriteria(): int;
    public function createCriteria(Criteria $criteria): void;
    public function deleteCriteria(string $id): void;
    public function searchCriteria(string $search): array;
    public function countSearchCriteria(string $search): int;  
}
?>