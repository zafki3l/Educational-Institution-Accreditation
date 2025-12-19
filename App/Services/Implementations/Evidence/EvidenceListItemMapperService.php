<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceListDTO;
use App\Services\Interfaces\Evidence\EvidenceItemMapperServiceInterface;
use DateTimeImmutable;

class EvidenceListItemMapperService implements EvidenceItemMapperServiceInterface
{
    public function mapItem(array $evidence): EvidenceListDTO
    {   
        return new EvidenceListDTO(
            $evidence['evidence_id'],
            $evidence['evidence_name'],
            $evidence['evaluation_milestone'],
            $evidence['decision'],
            $evidence['document_date'],
            $evidence['issue_place'],
            $evidence['link'],
            new DateTimeImmutable($evidence['created_at']),
            new DateTimeImmutable($evidence['updated_at']),
            $evidence['department_id']
        );
    }
}