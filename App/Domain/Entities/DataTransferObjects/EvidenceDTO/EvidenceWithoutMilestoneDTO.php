<?php

namespace App\Domain\Entities\DataTransferObjects\EvidenceDTO;

class EvidenceWithoutMilestoneDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id,
        string $name,
    ) {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            [
                'id',
                'name'
            ]
        );
    }
}
