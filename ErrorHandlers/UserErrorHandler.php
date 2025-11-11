<?php

namespace ErrorHandlers;

use App\Database\Repositories\Interfaces\UserRepositoryInterface;
use App\Database\Repositories\UserRepository;
use Core\ErrorHandler;

class UserErrorHandler extends ErrorHandler
{
    // Check is email exist
    public function isEmailExist(string $email, UserRepositoryInterface $userRepositoryInterface): bool
    {
        $result = $userRepositoryInterface->getUserByEmail($email);

        return !empty($result);
    }

    // Check email is invalid
    public function isEmailInvalid(string $email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Check password is correct
    public function isPasswordCorrect(string $db_password, string $user_input)
    {
        return password_verify($user_input, $db_password);
    }

    // Check password is not mismatch
    public function passwordMisMatch(string $password, string $password_confirmation): bool
    {
        return $password !== $password_confirmation;
    }

    // Check is password confirm
    public function isPasswordConfirm(string $password_confirmation): bool
    {
        return empty($password_confirmation);
    }
}
