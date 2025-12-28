<?php

namespace App\Http\Middlewares;

use App\Domain\Exceptions\AuthException\InvalidTokenException;
use App\Domain\Exceptions\AuthException\MissingCsrfTokenException;

class CSRF_Authenticator
{
    public function handle(): void
    {
        if (!$this->isTokenSet()) {
            throw new MissingCsrfTokenException();
        }

        $sessionToken = (string) $_SESSION['CSRF-token'];
        $formToken = (string) $_POST['CSRF-token'];

        if (!$this->verifyToken($sessionToken, $formToken)) {
            throw new InvalidTokenException();
        }

        if ($this->isTokenExpire()) {
            throw new InvalidTokenException();
        }

        unset($_SESSION['CSRF-token'], $_SESSION['token-expire']);
    }

    public static function generate()
    {
        if (empty($_SESSION['CSRF-token']) || time() >= ($_SESSION['token-expire'] ?? 0)) {
            $_SESSION['CSRF-token'] = bin2hex(random_bytes(32));
            $_SESSION['token-expire'] = time() + 3600;
        }
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
