<?php

namespace App\Services;

use App\Database\Models\User;
use App\Database\Repositories\UserRepository;
use ErrorHandlers\UserErrorHandler;
use Exception;
use Traits\HttpResponseTrait;

class AuthService
{
    use HttpResponseTrait;

    private const LOCK_TIME = 60;

    public function __construct(private User $user,
                                private UserRepository $userRepository,
                                private UserErrorHandler $userErrorHandler) {}

    public function handleLock(): void
    {
        $isLocked = time() < $_SESSION['lock_time'];
        if ($isLocked) {
            $remain = $_SESSION['lock_time'] - time();
            $_SESSION['locked'] = "Too many failed attempts. Please try again after {$remain} seconds.";
            $this->back();
        }
    }

    public function handleLogin(array $request)
    {
        // Error handling
        $errors = $this->loginErrorHandling($request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // If the user is sucessfully login
        $db_user = $this->userRepository->getUserByEmail($request['email']);
        $_SESSION['user'] = $this->setSession($db_user);

        $role_id = $_SESSION['user']['role_id'];

        return $role_id;
    }

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

    private function loginErrorHandling(array $request): array
    {
        $errors = [];

        try {
            $userData = $this->userRepository->getUserByEmail($request['email']);

            $isEmailExist = $this->userErrorHandler->isEmailExist($request['email'], $this->user);
            if (!$isEmailExist) {
                $errors['email-not-existed'] = 'Email is not exist! create a new account!';
            }

            if ($this->userErrorHandler->emptyInput($request['email'])) {
                $errors['empty-email'] = 'Email can not be empty!';
            }

            $user_password = $userData[0]['password'];
            $isPasswordCorrect = $this->userErrorHandler->isPasswordCorrect($user_password, $request['password']);
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
            $remain = 6 - $_SESSION['attempt_failed'];
            return 'You have ' . $remain . ' tries left.';
        }
    }
}