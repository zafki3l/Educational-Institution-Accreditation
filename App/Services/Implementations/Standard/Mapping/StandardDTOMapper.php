<?php

namespace App\Services\Implementations\Standard\Mapping;

use App\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;
use App\Entities\DataTransferObjects\StandardDTO\StandardCollectionDTO;
use App\Services\Implementations\Standard\Mapping\Factory\StandardItemMapperFactory;
use App\Services\Implementations\Standard\Mapping\ItemMappers\StandardItemType;

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