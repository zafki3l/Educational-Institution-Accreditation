<?php

namespace App\Services\Implementations\User\Mapping\ItemMappers;

use App\Entities\DataTransferObjects\UserDTO\UserByIdDTO;
use App\Services\Interfaces\User\Mapping\UserItemMapperInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class UserByIdItemMapper implements UserItemMapperInterface
{
    public function mapItem(array $user): UserByIdDTO
    {
        return new UserByIdDTO(
            $user['id'],
            $user['first_name'],
            $user['last_name'],
            $user['email'],
            $user['gender'],
            $user['role_id'],
            $user['department_id']
        );
    }
}