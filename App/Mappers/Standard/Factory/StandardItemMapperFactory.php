<?php

namespace App\Mappers\Standard\Factory;

use App\Mappers\Standard\ItemMappers\BaseStandardItemMapper;
use App\Mappers\Standard\ItemMappers\Interfaces\StandardItemMapperInterface;
use App\Mappers\Standard\ItemMappers\StandardItemType;
use App\Mappers\Standard\ItemMappers\StandardWithDepartmentItemMapper;

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