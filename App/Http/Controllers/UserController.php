<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Core\Controller;
use Core\Paginator;
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
        private UserErrorHandler $userErrorHandler
    ) {}

    public function index(): mixed
    {
        $user = $this->user;

        $isSearching = isset($_GET['search']);
        $search = $isSearching ? $_GET['search'] : null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $total_records = $isSearching ? $user->countSearchUser($search) : $user->countUser();

        $pagination = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page); // Calculate the total pages and the start page

        $users = $isSearching ? $user->searchUser($search, $pagination['start_from'], Paginator::RESULT_PER_PAGE) : $user->getAllUser($pagination['start_from'], Paginator::RESULT_PER_PAGE);

        return $this->view(
            'admin/users/index',
            'admin.layouts',
            [
                'title' => 'Quản lý người dùng',
                'users' => $users,
                'current_page' => $current_page,
                'total_pages' => $pagination['total_pages'],
                'result_per_page' => Paginator::RESULT_PER_PAGE
            ]
        );
    }

    public function create(): mixed
    {
        return $this->view(
            'admin/users/add',
            'admin.layouts',
            ['title' => 'Create new user']
        );
    }

    public function store(UserRequest $userRequest = new UserRequest()): void
    {
        $user = $this->user;

        $request = $userRequest->addUserRequest();

        // Errors handling
        $errors = $this->handleUserError($this->userErrorHandler, $request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // Create new User and store into Database
        $user->setFirstName($request['first_name']);
        $user->setLastName($request['last_name']);
        $user->setEmail($request['email']);
        $user->setGender($request['gender']);
        $user->setPassword($request['password']);
        $user->setRoleId($request['role']);

        $user->createUser();

        // Redirect back to dashboard if successfully
        $this->redirect('/admin/users');
    }

    public function edit(int $user_id): mixed
    {
        return $this->view(
            'admin/users/edit',
            'admin.layouts',
            [
                'title' => 'Edit user',
                'user' => $this->user->getUserById($user_id)
            ]
        );
    }

    public function update(int $user_id, UserRequest $userRequest = new UserRequest()): void
    {
        $user = $this->user;
        // Get request from user
        $request = $userRequest->updateUserRequest();

        // Handles errors
        $errors = $this->handleUserError($this->userErrorHandler, $request, true);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // Update user informations
        $user->setFirstName($request['first_name']);
        $user->setLastName($request['last_name']);
        $user->setEmail($request['email']);
        $user->setGender($request['gender']);
        $user->setRoleId($request['role_id']);

        $user->updateUserById($user_id);

        $_SESSION['edit-user-success'] = 'Edit user successfully!';

        // Redirect back to dashboard if successfully
        $this->redirect('/admin/users');
    }

    public function destroy(int $user_id): void
    {
        // Delete
        $this->user->deleteUser($user_id);

        $_SESSION['delete-user-success'] = 'Delete user successfully!';

        // Redirect back to dashboard if successfully
        $this->redirect('/admin/users');
    }

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
