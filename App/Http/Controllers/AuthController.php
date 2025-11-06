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

    // Constructor
    public function __construct(
        private User $user,
        private UserErrorHandler $userErrorHandler,
    ) {}

    /**
     * Shows login form
     * @return mixed
     */
    public function showLogin(): mixed
    {
        return $this->view(
            'auth/login',
            'homepage.layouts',
            ['title' => 'Login']
        );
    }

    /**
     * Handles user login
     * @param \App\Http\Requests\AuthRequest $authRequest
     * @return never
     */
    public function login(AuthRequest $authRequest = new AuthRequest()): void
    {
        // Get email & password from request
        $request = $authRequest->loginRequest();

        // Error handling
        $errors = $this->loginErrorHandling($this->userErrorHandler, $request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // Filling request data into user
        $this->user->fill($request);

        // If the user's password typed not matching
        $db_user = $this->user->getUserByEmail($this->user->email);
        $db_password = $db_user[0]['password'];
        if ((empty($db_user) || !password_verify($this->user->password, $db_password))) {
            $this->back();
        }

        // Redirect user if they successfully login
        $_SESSION['user'] = $this->setSession($db_user);
        if ($_SESSION['user']['role'] === User::ROLE_ADMIN) {
            $this->redirect('/admin/dashboard');
        }

        if ($_SESSION['user']['role'] === User::ROLE_BUSINESS_STAFF) {
            $this->redirect('/staff/dashboard');
        }

        $this->redirect('/');
    }

    /**
     * Handles user logout
     * @return void
     */
    public function logout()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();

            $this->redirect('/login');
        }
    }

    /**
     * Summary of setSession
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
            'role' => $db_user[0]['role']
        ];
    }

    /**
     * Handles login errors
     * @param \ErrorHandlers\UserErrorHandler $userErrorHandler
     * @return array<array>
     */
    private function loginErrorHandling(UserErrorHandler $userErrorHandler, array $request): array
    {
        $errors = [];

        try {
            $userData = $this->user->getUserByEmail($request['email']);

            // Email not exist handling
            if (!$userErrorHandler->isEmailExist($request['email'], $this->user)) {
                $errors['email-not-existed'] = 'Email is not exist! create a new account!';
            }

            // empty email handling
            if ($userErrorHandler->emptyInput($request['email'])) {
                $errors['empty-email'] = 'Email can not be empty!';
            }

            // Check password is correct

            $user_password = $userData[0]['password'];

            if (!$userErrorHandler->isPasswordCorrect($user_password, $request['password'])) {
                $errors['incorrect-password'] = 'Password incorrect!';
            }
        } catch (Exception $e) {
            // Exception error handling
            $errors['exception-error'] = $e->getMessage();
        }

        return $errors;
    }
}
