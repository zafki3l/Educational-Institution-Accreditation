<?php

namespace App\Services\Interfaces\User;

use App\DTO\UserDTO\BaseUserDTO;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
interface UserItemMapperServiceInterface
{
    public function mapItem(array $user): BaseUserDTO;
}