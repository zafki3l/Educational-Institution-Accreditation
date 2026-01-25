<?php

namespace App\Business\Modules\Standard\Mappers\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;

interface StandardItemMapperInterface
{
    public function mapItem(array $standard): BaseStandardDTO;
}