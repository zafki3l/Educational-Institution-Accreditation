<?php

namespace App\Services\Interfaces;

interface AuthServiceInterface
{
    public function handleLogin(array $request): array;
    
    public function handleError(array $request): ?array;
}