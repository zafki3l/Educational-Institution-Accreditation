<?php

namespace App\Domain\Entities\DataTransferObjects\StandardDTO;

use App\Domain\Entities\DataTransferObjects\BaseDTO;

class BaseStandardDTO extends BaseDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name
    ) {}

    public function fields(): array
    {
        return [
            'id',
            'name'
        ];
    }
}
