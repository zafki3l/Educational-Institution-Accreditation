<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceByIdDTO;
use App\Services\Interfaces\Evidence\EvidenceItemMapperServiceInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class EvidenceByIdItemMapperService implements EvidenceItemMapperServiceInterface
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