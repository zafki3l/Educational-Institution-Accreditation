<?php

namespace App\Entities\DataTransferObjects\EvidenceDTO;

use DateTimeImmutable;

class EvidenceListDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id, 
        string $name,
        protected readonly string $evaluation_milestone,
        protected readonly string $decision,
        protected readonly string $document_date,
        protected readonly string $issue_place,
        protected readonly string $link,
        protected readonly DateTimeImmutable $created_at,
        protected readonly DateTimeImmutable $updated_at,
        protected readonly int $department_id
    ) {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'evaluation_milestone',
                'decision',
                'document_date',
                'issue_place',
                'link',
                'created_at',
                'updated_at',
                'department_id'
            ]
        );
    }
}