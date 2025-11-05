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

    public function registerRequest(): array
    {
        return [
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'gender' => trim($_POST['gender']),
            'password' => trim($_POST['password']),
            'street' => trim($_POST['street']),
            'city' => trim($_POST['city'])
        ];
    }
}
