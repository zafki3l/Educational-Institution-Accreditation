<?php

namespace App\Business\Modules\Standard\Mappers\Factory;

use App\Business\Modules\Standard\Mappers\ItemMappers\BaseStandardItemMapper;
use App\Business\Modules\Standard\Mappers\ItemMappers\Interfaces\StandardItemMapperInterface;
use App\Business\Modules\Standard\Mappers\ItemMappers\StandardItemType;
use App\Business\Modules\Standard\Mappers\ItemMappers\StandardWithDepartmentItemMapper;

/**
 * Factory for creating standard item mappers based on the specified type.
 * Supports base and department-aware mapping implementations.
 */
class StandardItemMapperFactory
{
    public function createItemMapper(StandardItemType $type): StandardItemMapperInterface
    {
        $itemMapper = $this->resolveItemMapper($type);

        return new $itemMapper();
    }

    private function resolveItemMapper(StandardItemType $type): string
    {
        return match ($type) {
            StandardItemType::BASE => BaseStandardItemMapper::class,
            StandardItemType::WITH_DEPARTMENT => StandardWithDepartmentItemMapper::class
        };
    }
}