<?php

namespace App\Http\Middlewares;

use App\Models\User;
use Traits\HttpResponseTrait;

class EnsureStaff
{
    use HttpResponseTrait;

    public function handle(): void
    {
        $role = $_SESSION['user']['role'] ?? null;
        if (!User::isStaff($role)) {
            http_response_code(403);
            die("403 Forbidden Error! You don't have permission to visit this site!");
        }
    }
}