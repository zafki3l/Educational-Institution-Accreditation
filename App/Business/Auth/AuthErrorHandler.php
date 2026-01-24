<?php

namespace App\Business\Auth;

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