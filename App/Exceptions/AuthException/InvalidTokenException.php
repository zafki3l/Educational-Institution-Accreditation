<?php

namespace App\Exceptions\AuthException;

use App\Exceptions\BusinessException;

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