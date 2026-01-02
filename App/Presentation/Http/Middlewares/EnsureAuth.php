<?php

namespace App\Presentation\Http\Middlewares;

use App\Presentation\Http\Traits\HttpResponse;

class EnsureAuth
{
    use HttpResponse;

    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
    }
}