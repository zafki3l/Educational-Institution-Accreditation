<?php

namespace App\Http\Requests\Auth;

/**
 * Class AuthRequest
 * Get requests related to authentication
 */
abstract class AuthRequest
{
    protected string $email;
    protected string $password;

    public function getEmail(): string {return $this->email;}

	public function getPassword(): string {return $this->password;}
}
