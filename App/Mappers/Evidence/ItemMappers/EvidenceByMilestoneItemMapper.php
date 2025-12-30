<?php

namespace App\Mappers\Evidence\ItemMappers;

use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByMilestoneDTO;
use App\Services\Interfaces\Evidence\Mapping\EvidenceItemMapperInterface;

class EvidenceByMilestoneItemMapper implements EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): EvidenceByMilestoneDTO
    {
        return new EvidenceByMilestoneDTO(
            $evidence['evidence_id'],
            $evidence['evidence_name'],
            $evidence['milestone_id'],
            $evidence['milestone_name']
        );
    }
}