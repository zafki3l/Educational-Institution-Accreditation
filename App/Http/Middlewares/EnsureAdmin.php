<?php

namespace App\Http\Middlewares;

use App\Models\User;

class EnsureAdmin
{
    public function handle(): void
    {
        $role = $_SESSION['user']['role'] ?? null;
        if (!User::isAdmin($role)) {
            http_response_code(403);
            die("403 Forbidden Error! You don't have permission to visit this site!");
        }
    }
}