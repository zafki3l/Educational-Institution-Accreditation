<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Services\Interfaces\Evidence\EvidenceDTOMapperServiceInterface;
use App\Services\Interfaces\Evidence\EvidenceItemMapperServiceInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class EvidenceDTOMapperService implements EvidenceDTOMapperServiceInterface
{
    public function map(array $evidences, EvidenceItemMapperServiceInterface $itemMapper): EvidenceCollectionDTO
    {
        $collection = new EvidenceCollectionDTO();

        foreach ($evidences as $evidence) {
            $collection->append($itemMapper->mapItem($evidence));
        }
        
        return $collection;
    }
}