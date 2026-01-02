<?php

namespace App\Domain\Entities\DataTransferObjects\EvidenceDTO;

use DateTimeImmutable;

class EvidenceListDTO extends BaseEvidenceDTO
{
    public function __construct(
        string $id,
        string $name,
        public readonly string $evaluation_milestone,
        public readonly string $decision,
        public readonly string $document_date,
        public readonly string $issue_place,
        public readonly string $link,
        public readonly DateTimeImmutable $created_at,
        public readonly DateTimeImmutable $updated_at,
        public readonly int $department_id
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
