<?php

namespace App\Mappers\Milestone\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;

interface MilestoneItemMapperInterface
{
    public function mapItem(array $standard): BaseMilestoneDTO;
}