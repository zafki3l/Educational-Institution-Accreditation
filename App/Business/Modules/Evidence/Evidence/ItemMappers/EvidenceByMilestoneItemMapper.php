<?php

namespace App\Business\Modules\Evidence\Evidence\ItemMappers;

use App\Business\Modules\Evidence\Evidence\ItemMappers\Interfaces\EvidenceItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByMilestoneDTO;

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