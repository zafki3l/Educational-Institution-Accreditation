<?php

namespace App\Mappers\Milestone\Factory;

use App\Mappers\Milestone\ItemMappers\BaseMilestoneItemMapper;
use App\Mappers\Milestone\ItemMappers\Interfaces\MilestoneItemMapperInterface;
use App\Mappers\Milestone\ItemMappers\MilestoneItemType;
use App\Mappers\Milestone\ItemMappers\MilestoneListItemMapper;

class MilestoneItemMapperFactory
{
    public function createItemMapper(MilestoneItemType $type): MilestoneItemMapperInterface
    {
        $itemMapper = $this->resolveItemMapper($type);

        return new $itemMapper();
    }

    private function resolveItemMapper(MilestoneItemType $type): string
    {
        return match ($type) {
            MilestoneItemType::BASE => BaseMilestoneItemMapper::class,
            MilestoneItemType::LIST => MilestoneListItemMapper::class
        };
    }
}