<?php

namespace App\Business\Modules\Milestone\Mappers\ItemMappers;

use App\Business\Modules\Milestone\Mappers\ItemMappers\Interfaces\MilestoneItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;

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