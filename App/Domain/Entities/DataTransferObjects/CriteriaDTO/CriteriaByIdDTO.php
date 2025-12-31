<?php

namespace App\Domain\Entities\DataTransferObjects\CriteriaDTO;

class CriteriaByIdDTO extends BaseCriteriaDTO
{
    public function __construct(string $id, string $name, public readonly string $standard_id)
    {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            ['standard_id']
        );
    }
}