<?php

namespace App\Services\Interfaces\User;

use App\DTO\UserDTO\UserCollectionDTO;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
interface UserDTOMapperServiceInterface
{
    public function map(array $users, UserItemMapperServiceInterface $itemMapper): UserCollectionDTO;
}