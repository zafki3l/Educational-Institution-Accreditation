<?php

namespace App\Domain\Entities\DataTransferObjects\MilestoneDTO;

use DateTimeImmutable;

class MilestoneListDTO extends BaseMilestoneDTO
{
    public function __construct(
        string $id, string $criteria_id, string $name,
        public readonly DateTimeImmutable $created_at,
        public readonly DateTimeImmutable $updated_at)
    {
        parent::__construct($id, $criteria_id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'created_at',
                'updated_at'
            ]
        );
    }
}