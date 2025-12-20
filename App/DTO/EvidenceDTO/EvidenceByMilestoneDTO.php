<?php

namespace App\DTO\EvidenceDTO;

class EvidenceByMilestoneDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id, 
        string $name,
        public readonly string $milestone_id,
        public readonly string $milestone_name
    ) {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'milestone_id',
                'milestone_name'
            ]
        );
    }
}