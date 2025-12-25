<?php

namespace App\Services\Implementations\User\Mapping\Factory;

use App\Services\Implementations\User\Mapping\ItemMappers\UserByIdItemMapper;
use App\Services\Implementations\User\Mapping\ItemMappers\UserItemType;
use App\Services\Implementations\User\Mapping\ItemMappers\UserListItemMapper;
use App\Services\Interfaces\User\Mapping\UserItemMapperInterface;
use Exception;

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