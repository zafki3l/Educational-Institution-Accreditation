<?php

namespace App\Business\Modules\Milestone\Mappers;

use App\Business\Modules\Milestone\Mappers\Factory\MilestoneItemMapperFactory;
use App\Business\Modules\Milestone\Mappers\ItemMappers\MilestoneItemType;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\MilestoneCollectionDTO;


class MilestoneDTOMapper
{
    public function __construct(private MilestoneItemMapperFactory $factory) {}

    /**
     * Map all milestones
     * @param array $milestones
     * @param MilestoneItemType $type
     * @return MilestoneCollectionDTO
     */
    public function map(array $milestones, MilestoneItemType $type): MilestoneCollectionDTO
    {
        $collection = new MilestoneCollectionDTO();

        $itemMapper = $this->factory->createItemMapper($type);

        foreach ($milestones as $milestone) {
            $collection->append($itemMapper->mapItem($milestone));
        }

        return $collection;
    }

    /**
     * Map one milestone
     * @param array $milestone
     * @param MilestoneItemType $type
     * @return BaseMilestoneDTO
     */
    public function mapOne(array $milestone, MilestoneItemType $type): BaseMilestoneDTO
    {
        return $this->factory->createItemMapper($type)->mapItem($milestone);
    }
}