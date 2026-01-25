<?php

namespace App\Business\Modules\User\Mappers\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\UserDTO\BaseUserDTO;

interface UserItemMapperInterface
{
    public function mapItem(array $user): BaseUserDTO;
}