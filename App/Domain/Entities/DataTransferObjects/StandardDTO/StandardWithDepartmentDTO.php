<?php

namespace App\Domain\Entities\DataTransferObjects\StandardDTO;

class StandardWithDepartmentDTO extends BaseStandardDTO
{
    public function __construct(
        string $id,
        string $name,
        public readonly string $department_name
    ) {
        parent::__construct($id, $name);
    }

    public function fields(): array
    {
        return array_merge(
            parent::fields(),
            [
                'department_name'
            ]
        );
    }
}
