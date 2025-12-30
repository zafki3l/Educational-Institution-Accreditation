<?php

namespace App\Domain\Entities\DataTransferObjects\UserDTO;

use DateTimeImmutable;

class UserListDTO extends BaseUserDTO
{
    public function __construct(
        int $id,
        string $first_name,
        string $last_name,
        string $email,
        string $gender,
        public readonly string $department_name,
        public readonly string $role_name,
        public readonly DateTimeImmutable $created_at,
        public readonly DateTimeImmutable $updated_at
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
