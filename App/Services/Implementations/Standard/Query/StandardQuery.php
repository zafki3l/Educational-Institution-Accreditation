<?php

namespace App\Services\Implementations\Standard\Query;

use App\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;
use App\Entities\DataTransferObjects\StandardDTO\StandardCollectionDTO;
use App\Exceptions\StandardException\StandardNotFoundException;
use App\Repositories\Sql\Implementations\Standard\MysqlStandardRepository;
use App\Services\Implementations\Standard\Mapping\ItemMappers\StandardItemType;
use App\Services\Implementations\Standard\Mapping\StandardDTOMapper;

class StandardQuery
{
    public function __construct(private MysqlStandardRepository $repository,
                                private StandardDTOMapper $dtoMapper) {}

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