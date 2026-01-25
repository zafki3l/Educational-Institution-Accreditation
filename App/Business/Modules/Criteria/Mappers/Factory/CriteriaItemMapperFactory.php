<?php

namespace App\Business\Modules\Criteria\Mappers\Factory;

use App\Business\Modules\Criteria\Mappers\ItemMappers\CriteriaByIdItemMapper;
use App\Business\Modules\Criteria\Mappers\ItemMappers\CriteriaByStandardItemMapper;
use App\Business\Modules\Criteria\Mappers\ItemMappers\CriteriaItemType;
use App\Business\Modules\Criteria\Mappers\ItemMappers\CriteriaWithDepartmentItemMapper;
use App\Business\Modules\Criteria\Mappers\ItemMappers\Interfaces\CriteriaItemMapperInterface;

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