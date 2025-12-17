<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\Implementations\LockService;
use Core\Controller;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\SessionServiceInterface;
use Traits\HttpResponseTrait;

/**
 * Class AuthController
 * Handles login and logout.
 */
class AuthController extends Controller
{
    use HttpResponseTrait;

    // Constructor
    public function __construct(private AuthServiceInterface $authService,
                                private SessionServiceInterface $sessionService) {}

    public function showLogin(): mixed
    {
        return $this->view(
            'auth/login',
            'homepage.layouts',
            ['title' => 'Login']
        );
    }

    public function login(): void
    {
        $_SESSION['attempt_failed'] = isset($_SESSION['attempt_failed']) ? $_SESSION['attempt_failed'] : 0;
        $_SESSION['lock_time'] = isset($_SESSION['lock_time']) ? $_SESSION['lock_time'] : 0;

        //Handle lock
        if (LockService::isLocked()) {
            $this->back();
        }

        // Get email & password from request
        $request = new LoginRequest($_POST);

        // Handles errors
        $errors = $this->authService->handleError($request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        $db_user = $this->authService->handleLogin($request);
        $_SESSION['user'] = $this->sessionService->setUserSession($db_user);

        $this->redirectUserBasedOnRole($_SESSION['user']['role_id']);
        
        unset($_SESSION['attempt_failed'], $_SESSION['lock_time']);
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();

            $this->redirect('/login');
        }
    }

    private function redirectUserBasedOnRole(int $role_id): void 
    {
        $routes = [
            User::ROLE_ADMIN => '/admin/dashboard',
            User::ROLE_BUSINESS_STAFF => '/staff/dashboard',
            User::ROLE_USER => '/'
        ];

        $this->redirect($routes[$role_id] ?? '/');
    }
}
