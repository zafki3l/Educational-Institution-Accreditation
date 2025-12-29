<?php

namespace App\Domain\Exceptions\UserException;

use App\Domain\Exceptions\BusinessException;

class CreateUserFailedException extends BusinessException
{
    public function __construct(array $user)
    {
        parent::__construct(
            "Create new user failed",
            'USER_CREATED_FAILED'
        );

        $this->setMeta(['user' => $user]);
    }
}