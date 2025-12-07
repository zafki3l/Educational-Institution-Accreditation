<?php 

namespace App\Services\Implementations;

use App\Exceptions\CriteriaException\CriteriaNotFoundException;
use App\Models\Criteria;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use App\Services\Interfaces\CriteriaServiceInterface;

class CriteriaService implements CriteriaServiceInterface
{
    public function __construct(private CriteriaRepositoryInterface $criteriaRepository){}

    public function list(?string $search, array $filter): array
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

    public function create(array $request): void
    {
        $criteria = new Criteria();
        
        $criteria->setId($request['id'])
                ->setStandardId($request['standard_id'])
                ->setName($request['name'])
                ->setDepartmentId($request['department_id']);
        
        $this->criteriaRepository->create($criteria);
    }

    public function delete(string $criteria_id): void
    {
        $this->findOrFail($criteria_id);

        $this->criteriaRepository->deleteById($criteria_id);
    }

    public function filter(array $filter): array
    {
        return $this->criteriaRepository->filter($filter);
    }

    public function findAll(): array
    {
        return $this->criteriaRepository->allWithDepartment();
    }

    public function find(?string $search): array
    {
        return $this->criteriaRepository->search($search);
    }
    
    private function findOrFail(string $criteria_id): void
    {
        $found = $this->criteriaRepository->findById($criteria_id);

        if (!$found) {
            throw new CriteriaNotFoundException($criteria_id);
        }
    }

    private function filterArray(array $filter): array
    {
        return array_filter($filter, function ($value) {
            return !empty($value);
        });
    }

    public function count(): int
    {
        return $this->criteriaRepository->countAll();
    }
}