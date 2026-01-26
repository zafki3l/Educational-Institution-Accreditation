<?php

namespace App\Business\Modules\Evidence\Mappers\ItemMappers;

use App\Business\Modules\Evidence\Mappers\ItemMappers\Interfaces\EvidenceItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByIdDTO;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
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