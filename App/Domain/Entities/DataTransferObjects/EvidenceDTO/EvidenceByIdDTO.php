<?php

namespace App\Domain\Entities\DataTransferObjects\EvidenceDTO;

class EvidenceByIdDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id, 
        string $name, 
        protected readonly string $decision,
        protected readonly string $document_date,
        protected readonly string $issue_place,
        protected readonly string $link
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