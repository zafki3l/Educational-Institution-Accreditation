<?php

namespace App\Business\Modules\Criteria;

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaByIdDTO;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaCollectionDTO;
use App\Domain\Exceptions\CriteriaException\CriteriaNotFoundException;
use App\Mappers\Criteria\CriteriaDTOMapper;
use App\Mappers\Criteria\ItemMappers\CriteriaItemType;

/**
 * Application service responsible for querying standard's data
 */
class CriteriaQuery
{
    public function __construct(
        private CriteriaRepositoryInterface $repository,
        private CriteriaDTOMapper $dtoMapper
    ) {}

    /**
     * @param array $filter
     * @return CriteriaCollectionDTO
     */
    public function filter(array $filter): CriteriaCollectionDTO
    {
        $criterias = $this->repository->filter($filter);

        return $this->dtoMapper->map($criterias, CriteriaItemType::WITH_DEPARTMENT);
    }

    /**
     * @return CriteriaCollectionDTO
     */
    public function findAll(): CriteriaCollectionDTO
    {
        $criterias = $this->repository->allWithDepartment();

        return $this->dtoMapper->map($criterias, CriteriaItemType::WITH_DEPARTMENT);
    }

    /**
     * @return CriteriaCollectionDTO
     */
    public function criteriaByStandard(): CriteriaCollectionDTO
    {
        $criterias = $this->repository->criteriaByStandard();

        return $this->dtoMapper->map($criterias, CriteriaItemType::BY_STANDARD);
    }

    /**
     * @param mixed $search
     * @return CriteriaCollectionDTO
     */
    public function find(?string $search): CriteriaCollectionDTO
    {
        $criterias = $this->repository->search($search);

        return $this->dtoMapper->map($criterias, CriteriaItemType::WITH_DEPARTMENT);
    }

    /**
     * @param string $id
     * @throws CriteriaNotFoundException
     * @return \App\Domain\Entities\DataTransferObjects\CriteriaDTO\BaseCriteriaDTO
     */
    public function findOrFail(string $id): CriteriaByIdDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new CriteriaNotFoundException($id);
        }

        return $this->dtoMapper->mapOne($found[0], CriteriaItemType::BY_ID);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->repository->countAll();
    }
}
