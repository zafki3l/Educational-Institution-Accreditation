<?php

namespace App\Business\Modules\Evidence\Mappers;

use App\Business\Modules\Evidence\Mappers\Factory\EvidenceItemFactory;
use App\Business\Modules\Evidence\Mappers\ItemMappers\EvidenceItemType;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceCollectionDTO;

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