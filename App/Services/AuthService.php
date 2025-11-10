<?php

namespace App\Services;

use App\Database\Models\User;
use App\Database\Repositories\UserRepository;
use ErrorHandlers\UserErrorHandler;
use Exception;

class AuthService
{
    private const LOCK_TIME = 60;

    public function __construct(private User $user,
                                private UserRepository $userRepository,
                                private UserErrorHandler $userErrorHandler) {}

    public function handleLogin(array $request): array
    {
        // If the user is sucessfully login
        return $this->userRepository->getUserByEmail($request['email']);
    }

    public function handleError(array $request): ?array
    {
        $errors = $this->loginErrorHandling($request);

        return !empty($errors) ? $errors : null;
    }

    private function loginErrorHandling(array $request): array
    {
        $errors = [];

        try {
            $userData = $this->userRepository->getUserByEmail($request['email']);

            $isEmailExist = $this->userErrorHandler->isEmailExist($request['email'], $this->userRepository);
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