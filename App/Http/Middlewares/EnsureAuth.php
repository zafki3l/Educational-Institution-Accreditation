<?php

namespace App\Http\Middlewares;

use Traits\HttpResponseTrait;

class EnsureAuth
{
    use HttpResponseTrait;

    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
    }
}