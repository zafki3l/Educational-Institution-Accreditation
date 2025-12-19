<?php

namespace App\Services\Implementations\User;

use App\DTO\UserDTO\UserCollectionDTO;
use App\Services\Interfaces\User\UserDTOMapperServiceInterface;
use App\Services\Interfaces\User\UserItemMapperServiceInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class UserDTOMapperService implements UserDTOMapperServiceInterface
{
    public function map(array $users, UserItemMapperServiceInterface $itemMapper): UserCollectionDTO
    {
        $userCollection = new UserCollectionDTO();

        foreach ($users as $user) {
            $userCollection->append($itemMapper->mapItem($user));
        }

        return $userCollection;
    }
}