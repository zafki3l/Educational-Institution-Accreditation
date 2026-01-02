<?php

namespace App\Domain\Entities\DataTransferObjects\EvidenceDTO;

class EvidenceByIdDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id,
        string $name,
        public readonly string $decision,
        public readonly string $document_date,
        public readonly string $issue_place,
        public readonly string $link
    ) {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'decision',
                'document_date',
                'issue_place',
                'link'
            ]
        );
    }
}
