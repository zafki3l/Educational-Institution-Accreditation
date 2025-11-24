<?php

namespace App\Exceptions\UserException;

use App\Exceptions\BusinessException;

class UserNotFoundException extends BusinessException
{
    public function __construct(int $user_id)
    {
        parent::__construct(
            "User with ID $user_id not found",
            'USER_NOT_FOUND',
            404
        );

        $this->setMeta(['user_id' => $user_id]);
    }
}