<?php

namespace App\Services\Implementations\Standard\Mapping\ItemMappers;

use App\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;
use App\Services\Interfaces\Standard\Mapping\StandardItemMapperInterface;

class BaseStandardItemMapper implements StandardItemMapperInterface
{
    public function mapItem(array $standard): BaseStandardDTO
    {
        return new BaseStandardDTO(
            $standard['id'],
            $standard['name']
        );
    }
}