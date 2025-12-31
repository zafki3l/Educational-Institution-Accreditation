<?php

namespace App\Mappers\Milestone\ItemMappers;

use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;
use App\Mappers\Milestone\ItemMappers\Interfaces\MilestoneItemMapperInterface;

class BaseMilestoneItemMapper implements MilestoneItemMapperInterface
{
    public function mapItem(array $milestone): BaseMilestoneDTO
    {
        return new BaseMilestoneDTO(
            $milestone['id'],
            $milestone['criteria_id'],
            $milestone['name']
        );
    }
}