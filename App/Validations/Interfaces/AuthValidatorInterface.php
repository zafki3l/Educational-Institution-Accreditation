<?php

namespace App\Validations\Interfaces;

use App\Database\Repositories\Interfaces\UserRepositoryInterface;

interface AuthValidatorInterface
{
    public function loginErrorHandling(UserRepositoryInterface $userRepository, array $request): array;
}