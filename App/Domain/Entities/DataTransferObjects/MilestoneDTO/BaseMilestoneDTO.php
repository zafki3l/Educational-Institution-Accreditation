<?php

namespace App\Domain\Entities\DataTransferObjects\MilestoneDTO;

use App\Domain\Entities\DataTransferObjects\BaseDTO;

class BaseMilestoneDTO extends BaseDTO
{
    public function __construct(public readonly string $id,
                                public readonly string $criteria_id,
                                public readonly string $name) {}
    
    public function fields(): array
    {
        return [
            'id', 'criteria_id', 'name'
        ];
    }
}