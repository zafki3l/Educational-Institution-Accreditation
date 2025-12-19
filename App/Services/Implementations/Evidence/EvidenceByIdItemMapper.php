<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceByIdDTO;
use App\Services\Interfaces\Evidence\EvidenceItemMapperInterface;

class EvidenceByIdItemMapper implements EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): EvidenceByIdDTO
    {   
        return new EvidenceByIdDTO(
            $evidence['id'],
            $evidence['name'],
            $evidence['decision'],
            $evidence['document_date'],
            $evidence['issue_place'],
            $evidence['link']
        );
    }
}