<?php

namespace App\Business\Modules\Auth;

use App\Domain\Entities\Models\User;
use App\Presentation\Http\Requests\Auth\LoginRequest;

/**
 * Hide the complexity of the auth system.
 * Instead of the Controller talking to 5 different classes, it only talks 
 * to this one. This makes the Controller much easier to read and maintain.
 */
class AuthFacade
{
    public function __construct(
        private AuthQuery $query,
        private AuthErrorHandler $errorHandler
    ) {}

    /**
     * We need to get the request login user data for validation and authentication.
     *  
     * @param LoginRequest $request
     * @return array
     */
    public function getLoginUser(LoginRequest $request): array
    {
        $email = $request->getEmail();

        return $this->query->getLoginUser($email);
    }

    /**
     * If it returns errors, stop the login. If it returns null, keep going.
     * 
     * @param LoginRequest $request
     * @return array|null
     */
    public function handleError(LoginRequest $request): ?array
    {
        $user = $this->getLoginUser($request);

        return $this->errorHandler->handleError($user, $request);
    }

    /**
     * Mapping user and route based on their role, in order to prevent hard coding the url
     * @param int $role_id
     * @return string
     */
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
