<?php

namespace App\Business\Modules\Criteria\Mappers\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\CriteriaDTO\BaseCriteriaDTO;

interface CriteriaItemMapperInterface
{
    public function mapItem(array $criteria): BaseCriteriaDTO;
}