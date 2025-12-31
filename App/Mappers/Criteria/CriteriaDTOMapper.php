<?php

namespace App\Mappers\Criteria;

use App\Domain\Entities\DataTransferObjects\CriteriaDTO\BaseCriteriaDTO;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaCollectionDTO;
use App\Mappers\Criteria\Factory\CriteriaItemMapperFactory;
use App\Mappers\Criteria\ItemMappers\CriteriaItemType;

class CriteriaDTOMapper
{
    public function __construct(private CriteriaItemMapperFactory $factory) {}

    /**
     * Map all criterias
     * 
     * @param array $criterias
     * @param CriteriaItemType $type
     * @return CriteriaCollectionDTO
     */
    public function map(array $criterias, CriteriaItemType $type): CriteriaCollectionDTO
    {
        $collection = new CriteriaCollectionDTO();

        $itemMapper = $this->factory->createItemMapper($type);

        foreach ($criterias as $criteria) {
            $collection->append($itemMapper->mapItem($criteria));
        }

        return $collection;
    }

    /**
     * Map one criteria
     * 
     * @param array $criteria
     * @param CriteriaItemType $type
     * @return BaseCriteriaDTO
     */
    public function mapOne(array $criteria, CriteriaItemType $type): BaseCriteriaDTO
    {
        return $this->factory->createItemMapper($type)->mapItem($criteria);
    }
}