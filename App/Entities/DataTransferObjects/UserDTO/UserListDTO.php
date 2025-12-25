<?php

namespace App\Entities\DataTransferObjects\UserDTO;

use DateTimeImmutable;

class UserListDTO extends BaseUserDTO
{
    public function __construct(
        int $id,
        string $first_name,
        string $last_name,
        string $email,
        string $gender,
        protected readonly string $department_name,
        protected readonly string $role_name,
        protected readonly DateTimeImmutable $created_at,
        protected readonly DateTimeImmutable $updated_at
    ) {
        parent::__construct($id, $first_name, $last_name, $email, $gender);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'department_name',
                'role_name',
                'created_at',
                'updated_at'
            ]
        );
    }
}
