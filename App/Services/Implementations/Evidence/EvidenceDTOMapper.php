<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Services\Interfaces\Evidence\EvidenceDTOMapperInterface;
use App\Services\Interfaces\Evidence\EvidenceItemMapperInterface;

class EvidenceDTOMapper implements EvidenceDTOMapperInterface
{
    public function map(array $evidences, EvidenceItemMapperInterface $itemMapper): EvidenceCollectionDTO
    {
        $collection = new EvidenceCollectionDTO();

        foreach ($evidences as $evidence) {
            $collection->append($itemMapper->mapItem($evidence));
        }
        
        return $collection;
    }
}