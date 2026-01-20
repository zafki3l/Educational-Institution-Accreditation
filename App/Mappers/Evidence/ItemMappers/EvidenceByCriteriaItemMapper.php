<?php

namespace App\Mappers\Evidence\ItemMappers;

use App\Domain\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByCriteriaDTO;
use App\Mappers\Evidence\ItemMappers\Interfaces\EvidenceItemMapperInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class EvidenceByCriteriaItemMapper implements EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): EvidenceByCriteriaDTO
    {   
        return new EvidenceByCriteriaDTO(
            $evidence['id'],
            $evidence['name'],
            $evidence['criteria_id']
        );
    }
}