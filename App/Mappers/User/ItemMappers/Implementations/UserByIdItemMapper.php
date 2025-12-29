<?php

namespace App\Mappers\User\ItemMappers\Implementations;

use App\Domain\Entities\DataTransferObjects\UserDTO\UserByIdDTO;
use App\Mappers\User\ItemMappers\Interfaces\UserItemMapperInterface;

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