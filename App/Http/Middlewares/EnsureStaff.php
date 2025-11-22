<?php

namespace App\Http\Middlewares;

use App\Exceptions\AuthException\PermissionDeniedException;
use App\Models\User;

class EnsureStaff
{
    public function handle(): void
    {
        $role_id = $_SESSION['user']['role_id'] ?? null;
        
        if (!User::isStaff($role_id)) {
            throw new PermissionDeniedException($role_id);
        }
    }
}