<?php

namespace App\Domain\Entities\DataTransferObjects\UserDTO;

use App\Domain\Entities\DataTransferObjects\BaseDTO;

class BaseUserDTO extends BaseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $gender
    ) {}

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
