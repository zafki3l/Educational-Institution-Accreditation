<?php

namespace App\Mappers\Criteria\Factory;

use App\Mappers\Criteria\ItemMappers\CriteriaByIdItemMapper;
use App\Mappers\Criteria\ItemMappers\CriteriaByStandardItemMapper;
use App\Mappers\Criteria\ItemMappers\CriteriaItemType;
use App\Mappers\Criteria\ItemMappers\CriteriaWithDepartmentItemMapper;
use App\Mappers\Criteria\ItemMappers\Interfaces\CriteriaItemMapperInterface;

class CriteriaItemMapperFactory
{
    public function createItemMapper(CriteriaItemType $type): CriteriaItemMapperInterface
    {
        $itemMapper = $this->resolveItemMapper($type);

        return new $itemMapper();
    }

    private function resolveItemMapper(CriteriaItemType $type): string
    {
        return match ($type) {
            CriteriaItemType::WITH_DEPARTMENT => CriteriaWithDepartmentItemMapper::class,
            CriteriaItemType::BY_ID => CriteriaByIdItemMapper::class,
            CriteriaItemType::BY_STANDARD => CriteriaByStandardItemMapper::class
        };
    }
}