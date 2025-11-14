<?php 

namespace App\Services\Implementations;

use App\Database\Models\Criteria;
use App\Database\Repositories\Interfaces\CriteriaRepositoryInterface;
use App\Services\Interfaces\CriteriaServiceInterface;
use Core\Paginator;

class CriteriaService implements CriteriaServiceInterface
{
    public function __construct(private Criteria $criteria, 
                                private CriteriaRepositoryInterface $criteriaRepository){}

    public function listCriterias(?string $search, int $current_page): array
    {
        $total_records = $search ? $this->criteriaRepository->countSearchCriteria($search) 
                                : $this->criteriaRepository->countAllCriteria();

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $criterias = $search ? $this->find($search, $start_from, Paginator::RESULT_PER_PAGE) 
                            : $this->findAll($start_from, Paginator::RESULT_PER_PAGE);

        return [
            'criterias' => $criterias,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }

    public function findAll(int $start_from, int $result_per_page): array
    {
        return $this->criteriaRepository->getAllCriteria($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): array
    {
        return $this->criteriaRepository->searchCriteria($search, $start_from, $result_per_page);
    }
}