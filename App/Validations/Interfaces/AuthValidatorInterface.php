<?php

namespace App\Validations\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;

interface AuthValidatorInterface
{
    public function loginErrorHandling(UserRepositoryInterface $userRepository, LoginRequest $request): array;
}