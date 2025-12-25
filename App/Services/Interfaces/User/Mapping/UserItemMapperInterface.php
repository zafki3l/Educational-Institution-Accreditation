<?php

namespace App\Services\Interfaces\User\Mapping;

use App\DTO\UserDTO\BaseUserDTO;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
interface UserItemMapperInterface
{
    public function mapItem(array $user): BaseUserDTO;
}