<?php

namespace App\Validations\Implement;

use App\Presentation\Http\Requests\Auth\LoginRequest;
use App\Repositories\Sql\Implementations\User\MySqlUserRepository;
use App\Services\Implementations\Auth\AuthService;
use Core\Validator;

class AuthValidator extends Validator
{
    public function loginErrorHandling(MySqlUserRepository $userRepository, LoginRequest $request): array
    {
        $errors = [];

        $userData = $userRepository->findByEmail($request->getEmail());

        $isEmailExist = $this->isEmailExist($request->getEmail(), $userRepository);
        if (!$isEmailExist) {
            $errors['email-not-existed'] = 'Email is not exist! create a new account!';
        }

        if ($this->emptyInput($request->getEmail())) {
            $errors['empty-email'] = 'Email can not be empty!';
        }

        $user_password = $userData[0]['password'];
        $isPasswordCorrect = $this->isPasswordCorrect($user_password, $request->getPassword());
        if ($isEmailExist && !$isPasswordCorrect) {
            $errors['incorrect-password'] = 'Password incorrect!';
            $errors['failed_login'] = $this->handleFailedAttempt();
        }

        return $errors;
    }

    private function handleFailedAttempt(): string
    {
        $_SESSION['attempt_failed']++;

        if ($_SESSION['attempt_failed'] > 5) {
            $_SESSION['lock_time'] = time() + AuthService::LOCK_TIME;
            $_SESSION['attempt_failed'] = 0;

            return 'Too many failed attempts. Please try again in 10 minutes.';
        } else {
            $remain = 6 - $_SESSION['attempt_failed'];
            return 'You have ' . $remain . ' tries left.';
        }
    }

    private function isEmailExist(string $email, MySqlUserRepository $userRepository): bool
    {
        $result = $userRepository->findByEmail($email);

        return !empty($result);
    }

    private function isPasswordCorrect(?string $db_password, ?string $user_input): bool
    {
        return password_verify($user_input, $db_password);
    }
}