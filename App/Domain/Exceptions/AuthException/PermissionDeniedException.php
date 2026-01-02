<?php

namespace App\Domain\Exceptions\AuthException;

use App\Domain\Exceptions\BusinessException;

class PermissionDeniedException extends BusinessException
{
    public function __construct($role_id)
    {
        parent::__construct(
            "Permission denied! You do not have permission to visit this resource!",
            'PERMISSION_DENIED',
            403
        );

        $this->setMeta(['role_id' => $role_id]);
    }
}
