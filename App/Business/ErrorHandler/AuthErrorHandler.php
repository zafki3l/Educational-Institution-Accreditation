<?php

namespace App\Business\ErrorHandler;

use App\Business\Ports\UserRepositoryInterface;
use App\Business\Validations\Implementions\AuthValidator;
use App\Presentation\Http\Requests\Auth\LoginRequest;

class AuthErrorHandler
{
    public function __construct(private AuthValidator $validator) {}

    public function handleError(array $user, LoginRequest $request): ?array
    {
        $errors = $this->validator->loginErrorHandling($user, $request);

        return !empty($errors) ? $errors : null;
    }
}