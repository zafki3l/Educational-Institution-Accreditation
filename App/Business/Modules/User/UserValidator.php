<?php 

namespace App\Business\Modules\User;

use App\Presentation\Http\Requests\User\CreateUserRequest;
use App\Presentation\Http\Requests\User\UpdateUserRequest;
use App\Presentation\Http\Requests\User\UserRequest;
use App\Business\Ports\UserRepositoryInterface;
use Core\Validator;

/**
 * This class centralizes all validation logic for users. 
 */
class UserValidator extends Validator
{
    /**
     * To provide a single method that knows how to validate both 
     * NEW (Create) and EXISTING (Update) users by switching logic based on the $isUpdated flag.
     * @param UserRepositoryInterface $userRepository
     * @param UserRequest $request
     * @param bool $isUpdated
     * @return string[]
     */
    public function handleUserError(UserRepositoryInterface $userRepository, UserRequest $request, bool $isUpdated): array
    {
        $errors = [];

        $request = !$isUpdated ? new CreateUserRequest($_POST) : new UpdateUserRequest($_POST);

        if (!$isUpdated && $this->isEmailExist($request->getEmail(), $userRepository)) {
            $errors['email-existed'] = 'Email already existed!';
        }

        if ($this->isEmailInvalid($request->getEmail())) {
            $errors['email-invalid'] = 'Invalid email!';
        }

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

    /**
     * @param string $email
     * @param UserRepositoryInterface $userRepository
     * @return bool
     */
    private function isEmailExist(string $email, UserRepositoryInterface $userRepository): bool
    {
        $result = $userRepository->findByEmail($email);

        return !empty($result);
    }

    /**
     * @param string $email
     * @return bool
     */
    private function isEmailInvalid(string $email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}