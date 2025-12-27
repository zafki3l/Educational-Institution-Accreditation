<?php

namespace App\Services\Implementations\Standard\Mapping\ItemMappers;

use App\Entities\DataTransferObjects\StandardDTO\StandardWithDepartmentDTO;
use App\Services\Interfaces\Standard\Mapping\StandardItemMapperInterface;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
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