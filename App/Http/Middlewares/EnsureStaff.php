<?php

namespace App\Http\Middlewares;

use App\Models\User;
use Core\Middleware;
use Traits\HttpResponseTrait;

class EnsureStaff
{
    use HttpResponseTrait;

    public function handle(): void
    {
        $role = $_SESSION['user']['role'] ?? null;
        if (!in_array($role, [User::ROLE_STAFF, User::ROLE_ADMIN])) {
            http_response_code(403);
            die("403 Forbidden Error! You don't have permission to visit this site!");
        }
    }
}