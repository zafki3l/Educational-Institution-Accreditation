<?php

namespace App\Domain\Entities\DataTransferObjects\UserDTO;

class UserByIdDTO extends BaseUserDTO
{
    public function __construct(
        int $id,
        string $first_name,
        string $last_name,
        string $email,
        string $gender,
        public readonly int $department_id,
        public readonly int $role_id
    ) {
        parent::__construct($id, $first_name, $last_name, $email, $gender);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'department_id',
                'role_id'
            ]
        );
    }
}
