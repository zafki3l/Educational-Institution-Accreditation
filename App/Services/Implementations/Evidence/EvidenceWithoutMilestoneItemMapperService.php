<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceWithoutMilestoneDTO;
use App\Services\Interfaces\Evidence\EvidenceItemMapperServiceInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
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