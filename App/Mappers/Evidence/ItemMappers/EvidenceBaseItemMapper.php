<?php

namespace App\Mappers\Evidence\ItemMappers;

use App\Domain\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO;
use App\Mappers\Evidence\ItemMappers\Interfaces\EvidenceItemMapperInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class EvidenceBaseItemMapper implements EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): BaseEvidenceDTO
    {   
        return new BaseEvidenceDTO(
            $evidence['id'],
            $evidence['name']
        );
    }
}