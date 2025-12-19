<?php

namespace App\Services\Implementations\User;

use App\DTO\UserDTO\BaseUserDTO;
use App\DTO\UserDTO\UserByIdDTO;
use App\Services\Interfaces\User\UserItemMapperServiceInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
class UserByIdItemMapperService implements UserItemMapperServiceInterface
{
    public function mapItem(array $user): BaseUserDTO
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