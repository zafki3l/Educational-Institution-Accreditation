<?php

namespace App\Business\Auth;

use App\Business\ErrorHandler\AuthErrorHandler;
use App\Domain\Entities\Models\User;
use App\Presentation\Http\Requests\Auth\LoginRequest;

class AuthFacade
{
    public function __construct(
        private AuthQuery $query,
        private AuthErrorHandler $errorHandler
    ) {}

    public function getLoginUser(LoginRequest $request): array
    {
        $email = $request->getEmail();

        return $this->query->getLoginUser($email);
    }

    public function handleError(LoginRequest $request): ?array
    {
        $user = $this->getLoginUser($request);

        return $this->errorHandler->handleError($user, $request);
    }

    public function afterLogin(int $role_id): string
    {
        $routes = [
            User::ROLE_ADMIN => '/admin/dashboard',
            User::ROLE_BUSINESS_STAFF => '/staff/dashboard',
            User::ROLE_USER => '/'
        ];

        return $routes[$role_id] ?? '/';
    }
}
