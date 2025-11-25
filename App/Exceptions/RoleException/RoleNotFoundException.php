<?php

namespace App\Exceptions\RoleException;

use App\Exceptions\BusinessException;

class RoleNotFoundException extends BusinessException
{
    public function __construct(string $role_id)
    {
        parent::__construct(
            "Role with id $role_id not found", 
            'ROLE_NOT_FOUND',
            '404'
        );

        $this->setMeta(['role_id' => $role_id]);
    }
}