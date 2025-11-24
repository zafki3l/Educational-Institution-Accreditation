<?php 

namespace App\Services\Implementations;

use App\Models\Criteria;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use App\Services\Interfaces\CriteriaServiceInterface;

class CriteriaService implements CriteriaServiceInterface
{
    public function __construct(private Criteria $criteria, 
                                private CriteriaRepositoryInterface $criteriaRepository){}

    public function listCriterias(?string $search, array $filter): array
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filterCriteria($filter);

        return $this->findAll();
    }

    public function createCriteria(array $request): void
    {
        $this->criteria->setId($request['id'])
                        ->setStandardId($request['standard_id'])
                        ->setName($request['name'])
                        ->setDepartmentId($request['department_id']);
        
        $this->criteriaRepository->createCriteria($this->criteria);
    }

    public function deleteCriteria(string $id): void
    {
        $this->criteriaRepository->deleteCriteria($id);
    }

    public function filterCriteria(array $filter): array
    {
        return $this->criteriaRepository->getCriteriasByStandard($filter);
    }

    public function findAll(): array
    {
        return $this->criteriaRepository->getAllCriteriaWithDepartment();
    }

    public function find(?string $search): array
    {
        return $this->criteriaRepository->searchCriteria($search);
    }

    private function filterArray(array $filter): array
    {
        return array_filter($filter, function ($value) {
            return !empty($value);
        });
    }
}