<?php

namespace App\Business\Modules\Evidence\Mappers\ItemMappers;

use App\Business\Modules\Evidence\Mappers\ItemMappers\Interfaces\EvidenceItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO;

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