<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Core\Controller;
use App\Models\User;
use ErrorHandlers\UserErrorHandler;
use Exception;
use Traits\HttpResponseTrait;

/**
 * Class AuthController
 * Handles login, register and logout.
 */
class AuthController extends Controller
{
    use HttpResponseTrait;
    private const LOCK_TIME = 60;

    // Constructor
    public function __construct(
        private User $user,
        private UserErrorHandler $userErrorHandler,
    ) {}

    public function showLogin(): mixed
    {
        return $this->view(
            'auth/login',
            'homepage.layouts',
            ['title' => 'Login']
        );
    }

    public function login(AuthRequest $authRequest = new AuthRequest()): void
    {
        $_SESSION['attempt_failed'] = isset($_SESSION['attempt_failed']) ? $_SESSION['attempt_failed'] : 0;
        $_SESSION['lock_time'] = isset($_SESSION['lock_time']) ? $_SESSION['lock_time'] : 0;

        // If locked
        $isLocked = time() < $_SESSION['lock_time'];
        if ($isLocked) {
            $remain = $_SESSION['lock_time'] - time();
            $_SESSION['locked'] = "Too many failed attempts. Please try again after {$remain} seconds.";
            $this->back();
        }

        // Get email & password from request
        $request = $authRequest->loginRequest();

        // Error handling
        $errors = $this->loginErrorHandling($this->userErrorHandler, $request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // If the user is sucessfully login
        unset($_SESSION['attempt_failed'], $_SESSION['lock_time']);

        $db_user = $this->user->getUserByEmail($request['email']);
        $_SESSION['user'] = $this->setSession($db_user);

        $role_id = $_SESSION['user']['role_id'];
        if (User::isAdmin($role_id)) {
            $this->redirect('/admin/dashboard');
        }

        if (User::isStaff($role_id)) {
            $this->redirect('/staff/dashboard');
        }

        $this->redirect('/');
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();

            $this->redirect('/login');
        }
    }

    /**
     * Set user session when successfully login
     * @param array $db_user
     * @return array
     */
    private function setSession(array $db_user): array
    {
        return [
            'user_id' => $db_user[0]['id'],
            'first_name' => $db_user[0]['first_name'],
            'last_name' => $db_user[0]['last_name'],
            'email' => $db_user[0]['email'],
            'gender' => $db_user[0]['gender'],
            'role_id' => $db_user[0]['role_id']
        ];
    }

    private function loginErrorHandling(UserErrorHandler $userErrorHandler, array $request): array
    {
        $errors = [];

        try {
            $userData = $this->user->getUserByEmail($request['email']);

            $isEmailExist = $userErrorHandler->isEmailExist($request['email'], $this->user);
            if (!$isEmailExist) {
                $errors['email-not-existed'] = 'Email is not exist! create a new account!';
            }

            if ($userErrorHandler->emptyInput($request['email'])) {
                $errors['empty-email'] = 'Email can not be empty!';
            }

            $user_password = $userData[0]['password'];
            $isPasswordCorrect = $userErrorHandler->isPasswordCorrect($user_password, $request['password']);
            if (!$isPasswordCorrect) {
                $errors['incorrect-password'] = 'Password incorrect!';
                $errors['failed_login'] = $this->handleFailedAttempt();
            }
        } catch (Exception $e) {
            $errors['exception-error'] = $e->getMessage();
        }

        return $errors;
    }

    private function handleFailedAttempt(): string
    {
        $_SESSION['attempt_failed']++;

        if ($_SESSION['attempt_failed'] > 5) {
            $_SESSION['lock_time'] = time() + self::LOCK_TIME;
            $_SESSION['attempt_failed'] = 0;

            return 'Too many failed attempts. Please try again in 10 minutes.';
        } else {
            $remain = 5 - $_SESSION['attempt_failed'];
            return 'You have ' . $remain . ' tries left.';
        }
    }
}
