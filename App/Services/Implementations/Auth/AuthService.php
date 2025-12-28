<?php

namespace App\Services\Implementations\Auth;

use App\Presentation\Http\Requests\Auth\LoginRequest;
use App\Persistent\Repositories\Sql\Implementations\User\MySqlUserRepository;
use App\Validations\Implement\AuthValidator;

class AuthService
{
    public const LOCK_TIME = 60;

    public function __construct(private MySqlUserRepository $userRepository,
                                private AuthValidator $authValidator) {}

    public function handleLogin(LoginRequest $request): array
    {
        // If the user is sucessfully login
        return $this->userRepository->findByEmail($request->getEmail());
    }

    public function handleError(LoginRequest $request): ?array
    {
        $errors = $this->authValidator->loginErrorHandling($this->userRepository, $request);

        return !empty($errors) ? $errors : null;
    }
}