<?php

namespace App\Domain\Exceptions\AuthException;

use App\Domain\Exceptions\BusinessException;

class InvalidTokenException extends BusinessException
{
    public function __construct()
    {
        parent::__construct(
            "Invalid token!",
            'TOKEN_INVALID',
            401
        );
    }
}
