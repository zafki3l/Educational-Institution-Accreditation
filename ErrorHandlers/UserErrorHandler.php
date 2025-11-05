<?php

namespace ErrorHandlers;

use Core\ErrorHandler;

class UserErrorHandler extends ErrorHandler
{
    // Check is email exist
    public function isEmailExist($email, $user): bool
    {
        $result = $user->getUserByEmail($email);

        return !empty($result);
    }

    // Check email is invalid
    public function isEmailInvalid($email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Check password is correct
    public function isPasswordCorrect($db_password, $user_input)
    {
        return password_verify($user_input, $db_password);
    }

    // Check password is not mismatch
    public function passwordMisMatch($password, $password_confirmation): bool
    {
        return $password !== $password_confirmation;
    }

    // Check is password confirm
    public function isPasswordConfirm($password_confirmation): bool
    {
        return empty($password_confirmation);
    }
}
