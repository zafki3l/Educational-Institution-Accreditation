<?php

namespace App\Business\Modules\Criteria\Mappers\ItemMappers;

use App\Business\Modules\Criteria\Mappers\ItemMappers\Interfaces\CriteriaItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaByIdDTO;

class CriteriaByStandardItemMapper implements CriteriaItemMapperInterface
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