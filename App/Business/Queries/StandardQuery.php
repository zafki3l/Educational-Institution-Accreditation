<?php

namespace App\Business\Queries;

use App\Business\Ports\StandardRepositoryInterface;
use App\Domain\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;
use App\Domain\Entities\DataTransferObjects\StandardDTO\StandardCollectionDTO;
use App\Domain\Exceptions\StandardException\StandardNotFoundException;
use App\Mappers\Standard\ItemMappers\StandardItemType;
use App\Mappers\Standard\StandardDTOMapper;

class StandardQuery
{
    public function __construct(
        private StandardRepositoryInterface $repository,
        private StandardDTOMapper $dtoMapper
    ) {}

    public function allWithDepartment(): StandardCollectionDTO
    {
        $standards = $this->repository->allWithDepartment();

        return $this->dtoMapper->map($standards, StandardItemType::WITH_DEPARTMENT);
    }

    public function findAll(): StandardCollectionDTO
    {
        $standards = $this->repository->all();

        return $this->dtoMapper->map($standards, StandardItemType::BASE);
    }

    public function findOrFail(string $standard_id): BaseStandardDTO
    {
        $found = $this->repository->findById($standard_id);

        if (!$found) {
            throw new StandardNotFoundException($standard_id);
        }

        return $this->dtoMapper->mapOne($found[0], StandardItemType::BASE);
    }

    public function count(): int
    {
        return $this->repository->countAll();
    }
}
