<?php

namespace App\Services\Implementations\Evidence\Mapping;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Services\Implementations\Evidence\Mapping\Factory\EvidenceItemFactory;
use App\Services\Implementations\Evidence\Mapping\ItemMappers\EvidenceItemType;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class EvidenceDTOMapper
{
    public function __construct(private EvidenceItemFactory $factory) {}

    public function map(array $evidences, EvidenceItemType $type): mixed
    {
        $collection = new EvidenceCollectionDTO();

        $itemMapper = $this->factory->createItemMapper($type);

        foreach ($evidences as $evidence) {
            $collection->append($itemMapper->mapItem($evidence));
        }
        
        return $collection;
    }
}