<?php

namespace App\Http\Middlewares;

use App\Models\User;
use Traits\HttpResponseTrait;

class EnsureAdmin
{
    use HttpResponseTrait;

    public function handle(): void
    {
        $role = $_SESSION['user']['role'] ?? null;
        if ($role !== User::ROLE_ADMIN) {
            http_response_code(403);
            die("403 Forbidden Error! You don't have permission to visit this site!");
        }
    }
}