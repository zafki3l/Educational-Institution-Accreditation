<?php

namespace App\Presentation\Http\Middlewares;

use App\Domain\Entities\Models\User;
use App\Domain\Exceptions\AuthException\PermissionDeniedException;

class EnsureAdmin
{
    public function handle(): void
    {
        $role_id = $_SESSION['user']['role_id'] ?? null;
        
        if (!User::isAdmin($role_id)) {
            throw new PermissionDeniedException($role_id);
        }
    }
}