<?php

namespace App\Services\Implementations\Standard\Mapping\Factory;

use App\Services\Implementations\Standard\Mapping\ItemMappers\BaseStandardItemMapper;
use App\Services\Implementations\Standard\Mapping\ItemMappers\StandardItemType;
use App\Services\Implementations\Standard\Mapping\ItemMappers\StandardWithDepartmentItemMapper;
use App\Services\Interfaces\Standard\Mapping\StandardItemMapperInterface;

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