<?php

namespace App\Mappers\Criteria\ItemMappers;

use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaByIdDTO;
use App\Mappers\Criteria\ItemMappers\Interfaces\CriteriaItemMapperInterface;

class CriteriaByIdItemMapper implements CriteriaItemMapperInterface
{
    public function mapItem(array $criteria): CriteriaByIdDTO
    {
        return new CriteriaByIdDTO(
            $criteria['id'],
            $criteria['name'],
            $criteria['standard_id']
        );
    }
}