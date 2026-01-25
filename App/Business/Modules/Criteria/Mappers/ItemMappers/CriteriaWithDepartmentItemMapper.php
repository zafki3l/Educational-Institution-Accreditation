<?php

namespace App\Business\Modules\Criteria\Mappers\ItemMappers;

use App\Business\Modules\Criteria\Mappers\ItemMappers\Interfaces\CriteriaItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaWithDepartmentDTO;
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