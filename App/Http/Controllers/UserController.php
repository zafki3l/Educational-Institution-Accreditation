<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\User;
use Core\Controller;
use ErrorHandlers\UserErrorHandler;
use Exception;
use Traits\HttpResponseTrait;

/**
 * Class UserController
 * Handles logics related to User
 */
class UserController extends Controller
{
    // Traits
    use HttpResponseTrait;

    // Constructor
    public function __construct(
        private User $user,
        private Address $address,
        private UserErrorHandler $userErrorHandler,
    ) {}

    /**
     * Shows add user view
     * @return mixed
     */
    public function create(): mixed
    {
        return $this->view(
            'admin/addUser',
            'admin.layouts',
            ['title' => 'Create new user']
        );
    }

    /**
     * Handles add user
     * Redirect back to dashboard if successfully
     * 
     * @param \App\Http\Requests\UserRequest $userRequest
     * @return void
     */
    public function store(UserRequest $userRequest = new UserRequest()): void
    {
        // Get request from user
        $request = $userRequest->addUserRequest();

        // Errors handling
        $errors = $this->handleUserError($this->userErrorHandler, $request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // Create new User and store into Database
        $this->user->fill($request);
        $user_id = $this->user->createUser();

        $this->address->fill($request);
        $address_id = $this->address->createAddress();

        // Linking User and Address relationships
        $this->user->linkAddress($user_id, $address_id);

        // Redirect back to dashboard if successfully
        $this->redirect('/admin/dashboard');
    }

    /**
     * Shows edit user view
     * @param int $user_id
     * @return mixed
     */
    public function edit(int $user_id): mixed
    {
        return $this->view(
            'admin/editUser',
            'admin.layouts',
            [
                'title' => 'Edit user',
                'user' => $this->user->getUserById($user_id)
            ]
        );
    }

    /**
     * Handles update user
     * Redirect back to dashboard if successfully
     * 
     * @param int $user_id
     * @param \App\Http\Requests\UserRequest $userRequest
     * @return void
     */
    public function update(int $user_id, UserRequest $userRequest = new UserRequest()): void
    {
        // Get request from user
        $request = $userRequest->updateUserRequest();

        // Handles errors
        $errors = $this->handleUserError($this->userErrorHandler, $request, true);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // Update user informations
        $this->user->fill($request);
        $this->address->fill($request);

        $this->user->updateUserById($user_id);
        $this->address->updateAddressById($this->address->address_id);

        $_SESSION['edit-user-success'] = 'Edit user successfully!';

        // Redirect back to dashboard if successfully
        $this->redirect('/admin/dashboard');
    }

    /**
     * Delete User from Database
     * 
     * @param int $user_id
     * @param \App\Http\Requests\UserRequest $userRequest
     * @return void
     */
    public function destroy(int $user_id, UserRequest $userRequest = new UserRequest()): void
    {
        // Get request
        $request = $userRequest->deleteUserRequest();

        // Delete and unlink
        $user_id = $request['user_id'];
        $address_id = $request['address_id'];

        $this->user->unlinkUserAndAddress($user_id, $address_id);
        $this->user->deleteUser($user_id);
        $this->address->deleteAddress($address_id);

        $_SESSION['delete-user-success'] = 'Delete user successfully!';

        // Redirect back to dashboard if successfully
        $this->redirect('/admin/dashboard');
    }

    /**
     * Handles user errors
     * @param \ErrorHandlers\UserErrorHandler $userErrorHandler
     * @param array $request
     * @param bool $isUpdated
     * @return array<array|string>
     */
    private function handleUserError(UserErrorHandler $userErrorHandler, array $request, bool $isUpdated = false): array
    {
        $errors = [];

        try {
            // Email exist error handling
            if (!$isUpdated && $userErrorHandler->isEmailExist($request['email'], $this->user)) {
                $errors['email-existed'] = 'Email already existed!';
            }

            // Email validate error handling
            if ($userErrorHandler->isEmailInvalid($request['email'])) {
                $errors['email-invalid'] = 'Invalid email!';
            }

            // Empty input handling
            if ($userErrorHandler->emptyInput($request['first_name'])) {
                $errors['empty-firstname'] = 'First name can not be empty!';
            }

            if ($userErrorHandler->emptyInput($request['last_name'])) {
                $errors['empty-lastname'] = 'Last name can not be empty!';
            }

            if ($userErrorHandler->emptyInput($request['email'])) {
                $errors['empty-email'] = 'Email can not be empty!';
            }

            if ($userErrorHandler->emptyInput($request['gender'])) {
                $errors['empty-gender'] = 'Gender can not be empty!';
            }

            if (!$isUpdated && $userErrorHandler->emptyInput($request['password'])) {
                $errors['empty-password'] = 'Password can not be empty!';
            }
        } catch (Exception $e) {
            $errors['exception-error'][] = $e->getMessage();
        }

        return $errors;
    }
}
