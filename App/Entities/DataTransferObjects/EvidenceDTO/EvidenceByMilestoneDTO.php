<?php

namespace App\Entities\DataTransferObjects\EvidenceDTO;

class EvidenceByMilestoneDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id, 
        string $name,
        protected readonly string $milestone_id,
        protected readonly string $milestone_name
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