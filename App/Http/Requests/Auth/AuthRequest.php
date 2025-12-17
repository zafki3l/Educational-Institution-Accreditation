<?php

namespace App\Http\Requests\Auth;

/**
 * Class AuthRequest
 * Get requests related to authentication
 */
abstract class AuthRequest
{
    protected readonly string $email;
    protected readonly string $password;

    public function getEmail(): string {return $this->email;}

	public function getPassword(): string {return $this->password;}
}
