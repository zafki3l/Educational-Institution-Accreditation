<?php

namespace App\Business\Queries;

use App\Business\Ports\MilestoneRepositoryInterface;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\MilestoneCollectionDTO;
use App\Domain\Exceptions\MilestoneException\MilestoneNotFoundException;
use App\Mappers\Milestone\ItemMappers\MilestoneItemType;
use App\Mappers\Milestone\MilestoneDTOMapper;

class MilestoneQuery
{
    public function __construct(private MilestoneRepositoryInterface $repository,
                                private MilestoneDTOMapper $dtoMapper) {}

    public function filter(array $filter): MilestoneCollectionDTO
    {
        $milestones = $this->repository->filter($filter);

        return $this->dtoMapper->map($milestones, MilestoneItemType::LIST);
    }

    public function findAll(): MilestoneCollectionDTO
    {
        $milestones = $this->repository->all();

        return $this->dtoMapper->map($milestones, MilestoneItemType::LIST);
    }

    public function find(?string $search): MilestoneCollectionDTO
    {
        $milestones = $this->repository->find($search);

        return $this->dtoMapper->map($milestones, MilestoneItemType::LIST);
    }

    public function findOrFail(string $id): BaseMilestoneDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new MilestoneNotFoundException($id);
        }

        return $this->dtoMapper->mapOne($found[0], MilestoneItemType::BASE);
    }

    public function count(): int
    {
        return $this->repository->countAll();
    }
}