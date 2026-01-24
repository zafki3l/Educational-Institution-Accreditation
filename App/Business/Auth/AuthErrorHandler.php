<?php

namespace App\Business\Auth;

use App\Presentation\Http\Requests\Auth\LoginRequest;

/**
 * To keep the main Login process clean. Instead of cluttering the 
 * login logic with "if" statements for every possible failure, we 
 * offload all the "what went wrong?" checks here.
 */
class AuthErrorHandler
{
    /**
     * @param AuthValidator $validator
     */
    public function __construct(private AuthValidator $validator) {}

    /**
     * If it returns errors, stop the login. If it returns null, keep going.
     */
    public function handleError(array $user, LoginRequest $request): ?array
    {
        $errors = $this->validator->loginErrorHandling($user, $request);

        return !empty($errors) ? $errors : null;
    }
}