<?php

namespace App\Business\Modules\Milestone\Mappers\Factory;

use App\Business\Modules\Milestone\Mappers\ItemMappers\BaseMilestoneItemMapper;
use App\Business\Modules\Milestone\Mappers\ItemMappers\Interfaces\MilestoneItemMapperInterface;
use App\Business\Modules\Milestone\Mappers\ItemMappers\MilestoneItemType;
use App\Business\Modules\Milestone\Mappers\ItemMappers\MilestoneListItemMapper;

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