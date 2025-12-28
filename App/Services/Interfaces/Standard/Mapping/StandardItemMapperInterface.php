<?php

namespace App\Services\Interfaces\Standard\Mapping;

use App\Domain\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;

interface StandardItemMapperInterface
{
    public function mapItem(array $standard): BaseStandardDTO;
}