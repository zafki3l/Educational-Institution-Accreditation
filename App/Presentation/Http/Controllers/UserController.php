<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Facades\DepartmentFacade;
use App\Business\Facades\RoleFacade;
use App\Business\Facades\UserFacade;
use App\Presentation\Http\Requests\User\CreateUserRequest;
use App\Presentation\Http\Requests\User\UpdateUserRequest;
use Core\Controller;
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
    public function __construct(private UserFacade $userService,
                                private RoleFacade $roleService,
                                private DepartmentFacade $departmentService) {}

    public function index(): mixed
    {
        $search = $_GET['search'] ?? null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $data = $this->userService->list($search, $current_page);
        $users = $data['users'];

        return $this->view(
            'admin/users/index',
            'admin.layouts',
            [
                'title' => 'Quản lý người dùng',
                'users' => $users->toArray(),
                'current_page' => $data['current_page'],
                'total_pages' => $data['total_pages'],
                'result_per_page' => $data['result_per_page']
            ]
        );
    }

    public function create(): mixed
    {
        $departments = $this->departmentService->findAll();
        $roles = $this->roleService->findAll();

        return $this->view(
            'admin/users/add',
            'admin.layouts',
            [
                'title' => 'Create new user',
                'departments' => $departments,
                'roles' => $roles
            ]
        );
    }

    public function store(): void
    {
        $request = new CreateUserRequest($_POST);

        // Handles errors
        $errors = $this->userService->handleError($request, true);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        // Create new User and store into Database
        $this->userService->create($request);

        // Redirect back to dashboard if successfully
        $this->redirect('/admin/users');
    }

    public function edit(int $user_id): mixed
    {
        $user = $this->userService->findOrFail($user_id)->toArray();
        $departments = $this->departmentService->findAll();
        $roles = $this->roleService->findAll();

        return $this->view(
            'admin/users/edit',
            'admin.layouts',
            [
                'title' => 'Edit user',
                'user' => $user,
                'departments' => $departments,
                'roles' => $roles
            ]
        );
    }

    public function update(int $user_id): void
    {
        // Get request from user
        $request = new UpdateUserRequest($_POST);

        // Handles errors
        $errors = $this->userService->handleError($request, true);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        $this->userService->update($user_id, $request);

        $_SESSION['edit-user-success'] = 'Edit user successfully!';

        $this->redirect('/admin/users');
    }

    public function destroy(int $user_id): void
    {
        $this->userService->delete($user_id);

        $_SESSION['delete-user-success'] = 'Delete user successfully!';

        $this->redirect('/admin/users');
    }
}
