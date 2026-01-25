<?php

namespace App\Business\Modules\Auth;

use App\Business\Ports\UserRepositoryInterface;

class AuthQuery
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function getLoginUser(string $email)
    {
        // If the user is sucessfully login
        return $this->repository->findByEmail($email);
    }
}