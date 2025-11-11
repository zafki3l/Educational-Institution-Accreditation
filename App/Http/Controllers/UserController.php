<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Core\Controller;
use ErrorHandlers\UserErrorHandler;
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
        private UserRequest $userRequest,
        private UserService $userService,
        private UserErrorHandler $userErrorHandler
    ) {}

    public function index(): mixed
    {
        $search = $_GET['search'] ?? null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $data = $this->userService->listUsers($search, $current_page);

        return $this->view(
            'admin/users/index',
            'admin.layouts',
            [
                'title' => 'Quản lý người dùng',
                'users' => $data['users'],
                'current_page' => $data['current_page'],
                'total_pages' => $data['total_pages'],
                'result_per_page' => $data['result_per_page']
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

    public function store(): void
    {
        $request = $this->userRequest->addUserRequest();

        // Handles errors
        $errors = $this->userService->handleError($request, true);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // Create new User and store into Database
        $this->userService->createUser($request);

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
                'user' => $this->userService->findById($user_id)
            ]
        );
    }

    public function update(int $user_id): void
    {
        // Get request from user
        $request = $this->userRequest->updateUserRequest();

        // Handles errors
        $errors = $this->userService->handleError($request, true);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        $this->userService->updateUser($user_id, $request);

        $_SESSION['edit-user-success'] = 'Edit user successfully!';

        $this->redirect('/admin/users');
    }

    public function destroy(int $user_id): void
    {
        $this->userService->deleteUser($user_id);

        $_SESSION['delete-user-success'] = 'Delete user successfully!';

        $this->redirect('/admin/users');
    }
}
