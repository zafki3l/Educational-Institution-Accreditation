<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AuthRequest;
use Core\Controller;
use App\Services\Interfaces\AuthServiceInterface;
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
        $this->handleLock();

        // Get email & password from request
        $request = $this->authRequest->loginRequest();

        // Handles errors
        $errors = $this->authService->handleError($request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        $db_user = $this->authService->handleLogin($request);

        $_SESSION['user'] = $this->setSession($db_user);
        $role_id = $_SESSION['user']['role_id'];

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

    private function handleLock(): void
    {
        $isLocked = time() < $_SESSION['lock_time'];
        if ($isLocked) {
            $remain = $_SESSION['lock_time'] - time();
            $_SESSION['locked'] = "Too many failed attempts. Please try again after {$remain} seconds.";
            $this->back();
        }
    }

    private function setSession(array $db_user): array
    {
        return [
            'user_id' => $db_user[0]['id'],
            'first_name' => $db_user[0]['first_name'],
            'last_name' => $db_user[0]['last_name'],
            'email' => $db_user[0]['email'],
            'gender' => $db_user[0]['gender'],
            'role_id' => $db_user[0]['role_id'],
            'department_id' => $db_user[0]['department_id']
        ];
    }
}
