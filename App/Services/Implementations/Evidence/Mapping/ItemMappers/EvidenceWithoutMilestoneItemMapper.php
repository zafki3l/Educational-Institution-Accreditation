<?php

namespace App\Services\Implementations\Evidence\Mapping\ItemMappers;

use App\Entities\DataTransferObjects\EvidenceDTO\EvidenceWithoutMilestoneDTO;
use App\Services\Interfaces\Evidence\Mapping\EvidenceItemMapperInterface;

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