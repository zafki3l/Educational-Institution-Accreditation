<?php

namespace App\Services\Implementations\Evidence\Mapping\ItemMappers;

use App\DTO\EvidenceDTO\BaseEvidenceDTO;
use App\DTO\EvidenceDTO\EvidenceByMilestoneDTO;
use App\Services\Interfaces\Evidence\Mapping\EvidenceItemMapperInterface;

class EvidenceByMilestoneItemMapper implements EvidenceItemMapperInterface
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