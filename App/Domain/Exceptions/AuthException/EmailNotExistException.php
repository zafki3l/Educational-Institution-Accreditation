<?php

namespace App\Domain\Exceptions\AuthException;

use App\Domain\Exceptions\BusinessException;

class EmailNotExistException extends BusinessException
{
    public function __construct(string $email)
    {
        parent::__construct(
            "Email not exist!",
            'EMAIL_NOT_EXIST',
            400
        );

        $this->setMeta(['email' => $email]);
    }
}