<?php

namespace App\Business\Modules\Standard\Mappers\ItemMappers;

use App\Business\Modules\Standard\Mappers\ItemMappers\Interfaces\StandardItemMapperInterface;
use App\Domain\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;

/**
 * Application-level mapper responsible for transforming
 * raw user data into User DTO representations.
 *
 * This service encapsulates mapping logic and decouples
 * data sources from DTO construction.
 */
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