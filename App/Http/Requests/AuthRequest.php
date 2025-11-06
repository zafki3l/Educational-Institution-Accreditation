<?php

namespace App\Http\Requests;

/**
 * Class AuthRequest
 * Get requests related to authentication
 */
class AuthRequest
{
    public function loginRequest(): array
    {
        return [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];
    }
}
