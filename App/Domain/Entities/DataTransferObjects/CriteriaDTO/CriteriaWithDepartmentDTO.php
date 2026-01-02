<?php

namespace App\Domain\Entities\DataTransferObjects\CriteriaDTO;

use DateTimeImmutable;

class CriteriaWithDepartmentDTO extends BaseCriteriaDTO
{
    public function __construct(
        string $id,
        string $name,
        public readonly string $standard_name,
        public readonly string $department_name,
        public readonly DateTimeImmutable $created_at,
        public readonly DateTimeImmutable $updated_at
    ) {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'standard_name',
                'department_name',
                'created_at',
                'updated_at'
            ]
        );
    }
}
