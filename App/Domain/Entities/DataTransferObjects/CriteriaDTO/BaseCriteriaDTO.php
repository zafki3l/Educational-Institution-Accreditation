<?php

namespace App\Domain\Entities\DataTransferObjects\CriteriaDTO;

use Core\BaseDTO;

class BaseCriteriaDTO extends BaseDTO
{
    public function __construct(public readonly string $id,
                                public readonly string $name) {}

    public function fields(): array
    {
        return ['id', 'name'];
    }
}