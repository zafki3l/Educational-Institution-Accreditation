<?php

namespace App\Business\Queries;

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaByIdDTO;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaCollectionDTO;
use App\Domain\Exceptions\CriteriaException\CriteriaNotFoundException;
use App\Mappers\Criteria\CriteriaDTOMapper;
use App\Mappers\Criteria\ItemMappers\CriteriaItemType;

class CriteriaQuery
{
    public function __construct(private CriteriaRepositoryInterface $repository,
                                private CriteriaDTOMapper $dtoMapper) {}

    public function filter(array $filter): CriteriaCollectionDTO
    {
        $criterias = $this->repository->filter($filter);

        return $this->dtoMapper->map($criterias, CriteriaItemType::WITH_DEPARTMENT);
    }

    public function findAll(): CriteriaCollectionDTO
    {
        $criterias = $this->repository->allWithDepartment();

        return $this->dtoMapper->map($criterias, CriteriaItemType::WITH_DEPARTMENT);
    }

    public function find(?string $search): CriteriaCollectionDTO
    {
        $criterias = $this->repository->search($search);

        return $this->dtoMapper->map($criterias, CriteriaItemType::WITH_DEPARTMENT);
    }
    
    public function findOrFail(string $id): CriteriaByIdDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new CriteriaNotFoundException($id);
        }

        return $this->dtoMapper->mapOne($found[0], CriteriaItemType::BY_ID);
    }

    public function count(): int
    {
        return $this->repository->countAll();
    }
}