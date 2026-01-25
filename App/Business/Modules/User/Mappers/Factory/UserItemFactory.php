<?php

namespace App\Business\Modules\User\Mappers\Factory;

use App\Business\Modules\User\Mappers\ItemMappers\Interfaces\UserItemMapperInterface;
use App\Business\Modules\User\Mappers\ItemMappers\UserByIdItemMapper;
use App\Business\Modules\User\Mappers\ItemMappers\UserItemType;
use App\Business\Modules\User\Mappers\ItemMappers\UserListItemMapper;
use Exception;

/**
 * Factory for creating user item mappers based on the specified type.
 * Supports base and department-aware mapping implementations.
 */
class UserItemFactory
{
    public function createItemMapper(UserItemType $type): UserItemMapperInterface
    {
        $itemMapper = $this->resoveItemMapper($type);

        return new $itemMapper();
    }

    private function resoveItemMapper(UserItemType $type): string
    {
        return match ($type) {
            UserItemType::BY_ID => UserByIdItemMapper::class,
            UserItemType::LIST => UserListItemMapper::class,
            default => throw new Exception('UserItemType not found')
        };
    }     
}