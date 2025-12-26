<?php 

namespace App\Validations\Implement;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Repositories\Sql\Implementations\User\MySqlUserRepository;
use App\Validations\Interfaces\UserValidatorInterface;
use Core\Validator;

class UserValidator extends Validator implements UserValidatorInterface
{
    public function handleUserError(MySqlUserRepository $userRepository, UserRequest $request, bool $isUpdated): array
    {
        $errors = [];

        $request = !$isUpdated ? new CreateUserRequest($_POST) : new UpdateUserRequest($_POST);

        // Email exist error handling
        if (!$isUpdated && $this->isEmailExist($request->getEmail(), $userRepository)) {
            $errors['email-existed'] = 'Email already existed!';
        }

        // Email validate error handling
        if ($this->isEmailInvalid($request->getEmail())) {
            $errors['email-invalid'] = 'Invalid email!';
        }

        // Empty input handling
        if ($this->emptyInput($request->getFirstName())) {
            $errors['empty-firstname'] = 'First name can not be empty!';
        }

        if ($this->emptyInput($request->getLastName())) {
            $errors['empty-lastname'] = 'Last name can not be empty!';
        }

        if ($this->emptyInput($request->getEmail())) {
            $errors['empty-email'] = 'Email can not be empty!';
        }

        if ($this->emptyInput($request->getGender())) {
            $errors['empty-gender'] = 'Gender can not be empty!';
        }

        if (!$isUpdated && $this->emptyInput($request->getPassword())) {
            $errors['empty-password'] = 'Password can not be empty!';
        }

        return $errors;
    }

    // Check is email exist
    private function isEmailExist(string $email, MySqlUserRepository $userRepository): bool
    {
        $result = $userRepository->findByEmail($email);

        return !empty($result);
    }

    // Check email is invalid
    private function isEmailInvalid(string $email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}