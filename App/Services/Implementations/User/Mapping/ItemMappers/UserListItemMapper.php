<?php

namespace App\Services\Implementations\User\Mapping\ItemMappers;

use App\DTO\UserDTO\BaseUserDTO;
use App\DTO\UserDTO\UserListDTO;
use App\Services\Interfaces\User\Mapping\UserItemMapperInterface;
use DateTimeImmutable;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class UserListItemMapper implements UserItemMapperInterface
{
    public function mapItem(array $user): BaseUserDTO
    {
        return new UserListDTO(
            $user['id'],
            $user['first_name'],
            $user['last_name'],
            $user['email'],
            $user['gender'],
            $user['department_name'],
            $user['role_name'],
            new DateTimeImmutable($user['created_at']),
            new DateTimeImmutable($user['updated_at'])
        );
    }
}