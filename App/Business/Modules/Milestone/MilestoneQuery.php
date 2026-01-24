<?php

namespace App\Business\Modules\Milestone;

use App\Business\Ports\MilestoneRepositoryInterface;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\MilestoneCollectionDTO;
use App\Domain\Exceptions\MilestoneException\MilestoneNotFoundException;
use App\Mappers\Milestone\ItemMappers\MilestoneItemType;
use App\Mappers\Milestone\MilestoneDTOMapper;

/**
 * Application service responsible for querying standard's data
 */
class MilestoneQuery
{
    public function __construct(
        private MilestoneRepositoryInterface $repository,
        private MilestoneDTOMapper $dtoMapper
    ) {}

    /**
     * @param array $filter
     * @return MilestoneCollectionDTO
     */
    public function filter(array $filter): MilestoneCollectionDTO
    {
        $milestones = $this->repository->filter($filter);

        return $this->dtoMapper->map($milestones, MilestoneItemType::LIST);
    }

    /**
     * @return MilestoneCollectionDTO
     */
    public function findAll(): MilestoneCollectionDTO
    {
        $milestones = $this->repository->all();

        return $this->dtoMapper->map($milestones, MilestoneItemType::LIST);
    }

    /**
     * @return MilestoneCollectionDTO
     */
    public function milestoneByCriteria(): MilestoneCollectionDTO
    {
        $milestones = $this->repository->mileStoneByCriteria();

        return $this->dtoMapper->map($milestones, MilestoneItemType::BASE);
    }

    /**
     * @param mixed $search
     * @return MilestoneCollectionDTO
     */
    public function find(?string $search): MilestoneCollectionDTO
    {
        $milestones = $this->repository->find($search);

        return $this->dtoMapper->map($milestones, MilestoneItemType::LIST);
    }

    /**
     * @param string $id
     * @throws MilestoneNotFoundException
     * @return BaseMilestoneDTO
     */
    public function findOrFail(string $id): BaseMilestoneDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new MilestoneNotFoundException($id);
        }

        return $this->dtoMapper->mapOne($found[0], MilestoneItemType::BASE);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->repository->countAll();
    }
}
