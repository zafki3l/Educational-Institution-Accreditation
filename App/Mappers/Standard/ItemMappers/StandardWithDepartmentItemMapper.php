<?php

namespace App\Mappers\Standard\ItemMappers;

use App\Domain\Entities\DataTransferObjects\StandardDTO\StandardWithDepartmentDTO;
use App\Mappers\Standard\ItemMappers\Interfaces\StandardItemMapperInterface;

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