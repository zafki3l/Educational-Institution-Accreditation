<?php

namespace App\Mappers\Standard\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;

interface StandardItemMapperInterface
{
    public function mapItem(array $standard): BaseStandardDTO;
}