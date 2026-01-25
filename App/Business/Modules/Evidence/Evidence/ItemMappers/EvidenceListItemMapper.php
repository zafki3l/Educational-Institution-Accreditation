<?php

namespace App\Business\Modules\Evidence\Evidence\ItemMappers;

use App\Business\Modules\Evidence\Evidence\ItemMappers\Interfaces\EvidenceItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceListDTO;
use DateTimeImmutable;

class EvidenceListItemMapper implements EvidenceItemMapperInterface
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