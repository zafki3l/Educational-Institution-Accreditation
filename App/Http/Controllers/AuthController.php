<?php

namespace App\Http\Controllers;

use App\Database\Models\User;
use App\Http\Requests\AuthRequest;
use Core\Controller;
use App\Services\AuthService;
use Traits\HttpResponseTrait;

/**
 * Class AuthController
 * Handles login, register and logout.
 */
class AuthController extends Controller
{
    use HttpResponseTrait;

    // Constructor
    public function __construct(private AuthService $authService,
                                private AuthRequest $authRequest) {}

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

        // If locked
        $this->authService->handleLock();

        // Get email & password from request
        $request = $this->authRequest->loginRequest();

        $role_id = $this->authService->handleLogin($request);

        if (User::isAdmin($role_id)) {
            $this->redirect('/admin/dashboard');
        }

        if (User::isStaff($role_id)) {
            $this->redirect('/staff/dashboard');
        }

        $this->redirect('/');

        unset($_SESSION['attempt_failed'], $_SESSION['lock_time']);
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();

            $this->redirect('/login');
        }
    }
}
