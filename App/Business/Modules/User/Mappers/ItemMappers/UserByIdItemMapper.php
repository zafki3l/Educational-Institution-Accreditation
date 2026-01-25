<?php

namespace App\Business\Modules\User\Mappers\ItemMappers;

use App\Business\Modules\User\Mappers\ItemMappers\Interfaces\UserItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\UserDTO\UserByIdDTO;

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