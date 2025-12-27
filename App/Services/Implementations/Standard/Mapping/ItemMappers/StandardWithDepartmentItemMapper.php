<?php

namespace App\Services\Implementations\Standard\Mapping\ItemMappers;

use App\Entities\DataTransferObjects\StandardDTO\StandardWithDepartmentDTO;
use App\Services\Interfaces\Standard\Mapping\StandardItemMapperInterface;

class StandardWithDepartmentItemMapper implements StandardItemMapperInterface
{
    public function mapItem(array $standard): StandardWithDepartmentDTO
    {
        return new StandardWithDepartmentDTO(
            $standard['id'],
            $standard['name'],
            $standard['department_name']
        );
    }
}