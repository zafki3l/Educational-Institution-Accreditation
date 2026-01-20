<?php

namespace App\Domain\Entities\DataTransferObjects\EvidenceDTO;

class EvidenceByCriteriaDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id,
        string $name,
        public readonly string $criteria_id
    ) {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'criteria_id'
            ]
        );
    }
}
