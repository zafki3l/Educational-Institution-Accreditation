<?php

namespace App\Presentation\Http\Requests\Auth;

class LoginRequest extends AuthRequest
{
    public function __construct(array $input)
    {
        $this->email = trim($input['email']);
        $this->password = trim($input['password']);
    }
}