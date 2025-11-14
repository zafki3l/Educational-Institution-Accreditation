<?php 
namespace App\Database\Repositories\Interfaces;

use App\Database\Models\Criteria;

interface CriteriaRepositoryInterface
{
    public function getAllCriteria(int $start_from, int $result_per_page): array;
    public function countAllCriteria(): int;
    public function searchCriteria(string $search, int $start_from, int $result_per_page): array;
    public function countSearchCriteria(string $search): int;  
}
?>