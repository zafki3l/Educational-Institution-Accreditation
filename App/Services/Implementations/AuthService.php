<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use App\Validations\Interfaces\AuthValidatorInterface;

class AuthService implements AuthServiceInterface
{
    public const LOCK_TIME = 60;

    public function __construct(private UserRepositoryInterface $userRepository,
                                private AuthValidatorInterface $authValidator) {}

    public function handleLogin(array $request): array
    {
        // If the user is sucessfully login
        return $this->userRepository->findByEmail($request['email']);
    }

    public function handleError(array $request): ?array
    {
        $errors = $this->authValidator->loginErrorHandling($this->userRepository, $request);

        return !empty($errors) ? $errors : null;
    }
}