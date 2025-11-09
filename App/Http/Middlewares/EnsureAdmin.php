<?php

namespace App\Http\Middlewares;

use App\Models\User;

class EnsureAdmin
{
    public function handle(): void
    {
        $role_id = $_SESSION['user']['role_id'] ?? null;
        if (!User::isAdmin($role_id)) {
            http_response_code(403);
            die("403 Forbidden Error! You don't have permission to visit this site!");
        }
    }
}