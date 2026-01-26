<?php

namespace App\Business\Modules\Evidence\Mappers\ItemMappers;

use App\Business\Modules\Evidence\Mappers\ItemMappers\Interfaces\EvidenceItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByCriteriaDTO;

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
            $evidence['criteria_id'],
            $evidence['link']
        );
    }
}