<?php

namespace App\Mappers\User\Factory;

use App\Mappers\User\ItemMappers\UserByIdItemMapper;
use App\Mappers\User\ItemMappers\UserItemType;
use App\Mappers\User\ItemMappers\UserListItemMapper;
use App\Mappers\User\ItemMappers\Interfaces\UserItemMapperInterface;
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