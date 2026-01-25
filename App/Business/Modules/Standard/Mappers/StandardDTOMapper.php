<?php

namespace App\Business\Modules\Standard\Mappers;

use App\Business\Modules\Standard\Mappers\Factory\StandardItemMapperFactory;
use App\Business\Modules\Standard\Mappers\ItemMappers\StandardItemType;
use App\Domain\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;
use App\Domain\Entities\DataTransferObjects\StandardDTO\StandardCollectionDTO;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class StandardDTOMapper
{
    public function __construct(private StandardItemMapperFactory $factory) {}

    /**
     * Map all standards
     * 
     * @param array $standards
     * @param StandardItemType $type
     * @return StandardCollectionDTO
     */
    public function map(array $standards, StandardItemType $type): StandardCollectionDTO
    {
        $collection = new StandardCollectionDTO();

        $itemMapper = $this->factory->createItemMapper($type);

        foreach ($standards as $standard) {
            $collection->append($itemMapper->mapItem($standard));
        }

        return $collection;
    }

    /**
     * Map one standard
     * 
     * @param array $standard
     * @param StandardItemType $type
     * @return BaseStandardDTO
     */
    public function mapOne(array $standard, StandardItemType $type): BaseStandardDTO
    {
        return $this->factory->createItemMapper($type)->mapItem($standard);
    }
}