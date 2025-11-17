<?php 

namespace App\Validations\Implement;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Validations\Interfaces\UserValidatorInterface;
use Core\Validator;

class UserValidator extends Validator implements UserValidatorInterface
{
    public function handleUserError(UserRepositoryInterface $userRepository, array $request, bool $isUpdated): array
    {
        $errors = [];

        // Email exist error handling
        if (!$isUpdated && $this->isEmailExist($request['email'], $userRepository)) {
            $errors['email-existed'] = 'Email already existed!';
        }

        // Email validate error handling
        if ($this->isEmailInvalid($request['email'])) {
            $errors['email-invalid'] = 'Invalid email!';
        }

        // Empty input handling
        if ($this->emptyInput($request['first_name'])) {
            $errors['empty-firstname'] = 'First name can not be empty!';
        }

        if ($this->emptyInput($request['last_name'])) {
            $errors['empty-lastname'] = 'Last name can not be empty!';
        }

        if ($this->emptyInput($request['email'])) {
            $errors['empty-email'] = 'Email can not be empty!';
        }

        if ($this->emptyInput($request['gender'])) {
            $errors['empty-gender'] = 'Gender can not be empty!';
        }

        if (!$isUpdated && $this->emptyInput($request['password'])) {
            $errors['empty-password'] = 'Password can not be empty!';
        }

        return $errors;
    }

    // Check is email exist
    private function isEmailExist(string $email, UserRepositoryInterface $userRepository): bool
    {
        $result = $userRepository->getUserByEmail($email);

        return !empty($result);
    }

    // Check email is invalid
    private function isEmailInvalid(string $email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}