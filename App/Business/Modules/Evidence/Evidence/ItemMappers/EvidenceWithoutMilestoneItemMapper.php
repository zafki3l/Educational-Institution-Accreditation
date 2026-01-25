<?php

namespace App\Business\Modules\Evidence\Evidence\ItemMappers;

use App\Business\Modules\Evidence\Evidence\ItemMappers\Interfaces\EvidenceItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceWithoutMilestoneDTO;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class EvidenceWithoutMilestoneItemMapper implements EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): EvidenceWithoutMilestoneDTO
    {   
        return new EvidenceWithoutMilestoneDTO(
            $evidence['evidence_id'],
            $evidence['evidence_name']
        );
    }
}