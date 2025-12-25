<?php

namespace App\Services\Implementations\Evidence\Mapping;

use App\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO;
use App\Entities\DataTransferObjects\EvidenceDTO\EvidenceCollectionDTO;
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

    /**
     * Map all evidences
     * 
     * @param array $evidences
     * @param EvidenceItemType $type
     * @return EvidenceCollectionDTO
     */
    public function map(array $evidences, EvidenceItemType $type): EvidenceCollectionDTO
    {
        $collection = new EvidenceCollectionDTO();

        $itemMapper = $this->factory->createItemMapper($type);

        foreach ($evidences as $evidence) {
            $collection->append($itemMapper->mapItem($evidence));
        }
        
        return $collection;
    }

    /**
     * Map one evidence
     * @param array $evidence
     * @param EvidenceItemType $type
     * @return BaseEvidenceDTO
     */
    public function mapOne(array $evidence, EvidenceItemType $type): BaseEvidenceDTO
    {
        return $this->factory->createItemMapper($type)->mapItem($evidence);
    }
}