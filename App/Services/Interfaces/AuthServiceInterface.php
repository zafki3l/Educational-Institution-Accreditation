<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Auth\LoginRequest;

interface AuthServiceInterface
{
    public function handleLogin(LoginRequest $request): array;
    
    public function handleError(LoginRequest $request): ?array;
}