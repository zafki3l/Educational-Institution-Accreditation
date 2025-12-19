<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Services\Interfaces\Evidence\EvidenceDTOMapperServiceInterface;
use App\Services\Interfaces\Evidence\EvidenceItemMapperServiceInterface;

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