<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\BaseEvidenceDTO;
use App\DTO\EvidenceDTO\EvidenceByMilestoneDTO;
use App\Services\Interfaces\Evidence\EvidenceItemMapperServiceInterface;

class EvidenceByMilestoneItemMapperService implements EvidenceItemMapperServiceInterface
{
    public function mapItem(array $evidence): BaseEvidenceDTO
    {
        return new EvidenceByMilestoneDTO(
            $evidence['evidence_id'],
            $evidence['evidence_name'],
            $evidence['milestone_id'],
            $evidence['milestone_name']
        );
    }
}