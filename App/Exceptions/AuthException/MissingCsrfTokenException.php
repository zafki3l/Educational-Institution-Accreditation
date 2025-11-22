<?php

namespace App\Exceptions\AuthException;

use App\Exceptions\BusinessException;

class MissingCsrfTokenException extends BusinessException
{
    public function __construct()
    {
        parent::__construct(
            "Token is missing!",
            'TOKEN_MISSING',
            401
        );
    }
}