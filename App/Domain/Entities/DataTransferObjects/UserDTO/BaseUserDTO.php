<?php

namespace App\Domain\Entities\DataTransferObjects\UserDTO;

use Core\BaseDTO;

class BaseUserDTO extends BaseDTO
{
    public function __construct(protected readonly int $id, 
                                protected readonly string $first_name,
                                protected readonly string $last_name,
                                protected readonly string $email,
                                protected readonly string $gender) {}

    public function fields(): array
    {
        return [
            'id',
            'first_name',
            'last_name',
            'email',
            'gender'
        ];
    }
}