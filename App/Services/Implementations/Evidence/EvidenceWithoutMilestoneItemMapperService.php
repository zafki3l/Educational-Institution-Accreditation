<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceWithoutMilestoneDTO;
use App\Services\Interfaces\Evidence\EvidenceItemMapperServiceInterface;

class EvidenceWithoutMilestoneItemMapperService implements EvidenceItemMapperServiceInterface
{
    public function mapItem(array $evidence): EvidenceWithoutMilestoneDTO
    {   
        return new EvidenceWithoutMilestoneDTO(
            $evidence['evidence_id'],
            $evidence['evidence_name']
        );
    }
}