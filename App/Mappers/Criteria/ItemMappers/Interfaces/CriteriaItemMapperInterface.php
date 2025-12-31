<?php

namespace App\Mappers\Criteria\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\CriteriaDTO\BaseCriteriaDTO;

interface CriteriaItemMapperInterface
{
    public function mapItem(array $criteria): BaseCriteriaDTO;
}