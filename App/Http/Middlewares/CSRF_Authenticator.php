<?php

namespace App\Http\Middlewares;

class CSRF_Authenticator
{
    public static function generate()
    {
        if (empty($_SESSION['CSRF-token']) || time() >= ($_SESSION['token-expire'] ?? 0)) {
            $_SESSION['CSRF-token'] = bin2hex(random_bytes(32));
            $_SESSION['token-expire'] = time() + 3600;
        }
    }
    
    public function handle(): void
    {
        if (!$this->isTokenSet()) {
            exit('Missing CSRF token');
        }

        $sessionToken = (string) $_SESSION['CSRF-token'];
        $formToken = (string) $_POST['CSRF-token'];

        if (!$this->verifyToken($sessionToken, $formToken)) {
            exit('405 error!');
        }

        if ($this->isTokenExpire()) {
            exit('token expired');
        }

        unset($_SESSION['CSRF-token'], $_SESSION['token-expire']);
    }

    private function isTokenSet(): bool
    {
        return isset($_SESSION['CSRF-token'], $_POST['CSRF-token']);
    }
    
    private function verifyToken(string $sessionToken, string $formToken): bool
    {
        return hash_equals($sessionToken, $formToken);
    }

    private function isTokenExpire(): bool
    {
        return time() >= $_SESSION['token-expire'];
    }
}
