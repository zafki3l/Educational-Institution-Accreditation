<?php

namespace App\Validations\Interfaces;

use App\Repositories\Sql\Interfaces\UserRepositoryInterface;

interface AuthValidatorInterface
{
    public function loginErrorHandling(UserRepositoryInterface $userRepository, array $request): array;
}