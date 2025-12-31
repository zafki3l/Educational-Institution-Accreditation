<?php

namespace App\Mappers\Criteria\ItemMappers;

use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaWithDepartmentDTO;
use App\Mappers\Criteria\ItemMappers\Interfaces\CriteriaItemMapperInterface;
use DateTimeImmutable;

class CriteriaWithDepartmentItemMapper implements CriteriaItemMapperInterface
{
    public function mapItem(array $criteria): CriteriaWithDepartmentDTO
    {
        return new CriteriaWithDepartmentDTO(
            $criteria['criteria_id'],
            $criteria['criteria_name'],
            $criteria['standard_name'],
            $criteria['department_name'],
            new DateTimeImmutable($criteria['created_at']),
            new DateTimeImmutable($criteria['updated_at'])
        );
    }
}