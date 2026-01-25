<?php

namespace App\Business\Modules\Milestone\Mappers\ItemMappers;

use App\Business\Modules\Milestone\Mappers\ItemMappers\Interfaces\MilestoneItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\MilestoneListDTO;
use DateTimeImmutable;

class MilestoneListItemMapper implements MilestoneItemMapperInterface
{
    public function mapItem(array $milestone): MilestoneListDTO
    {
        return new MilestoneListDTO(
            $milestone['id'],
            $milestone['criteria_id'],
            $milestone['name'],
            new DateTimeImmutable($milestone['created_at']),
            new DateTimeImmutable($milestone['updated_at'])
        );
    }
}