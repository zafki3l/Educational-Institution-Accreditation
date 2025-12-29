<?php

namespace App\Mappers\User\ItemMappers\Implementations;

use App\Domain\Entities\DataTransferObjects\UserDTO\UserListDTO;
use App\Mappers\User\ItemMappers\Interfaces\UserItemMapperInterface;
use DateTimeImmutable;

class UserListItemMapper implements UserItemMapperInterface
{
    public function mapItem(array $user): UserListDTO
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