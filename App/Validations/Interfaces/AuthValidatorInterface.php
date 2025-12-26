<?php

namespace App\Validations\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Sql\Implementations\User\MySqlUserRepository;

interface AuthValidatorInterface
{
    public function loginErrorHandling(MySqlUserRepository $userRepository, LoginRequest $request): array;
}