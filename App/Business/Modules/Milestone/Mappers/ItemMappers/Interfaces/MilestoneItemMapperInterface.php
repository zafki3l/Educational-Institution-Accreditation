<?php

namespace App\Business\Modules\Milestone\Mappers\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;

interface MilestoneItemMapperInterface
{
    public function mapItem(array $standard): BaseMilestoneDTO;
}