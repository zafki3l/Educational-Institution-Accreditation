<?php

namespace App\Services;

use App\Database\Models\User;
use App\Database\Repositories\UserRepository;
use Core\Paginator;
use ErrorHandlers\UserErrorHandler;
use Exception;

class UserService
{
    public function __construct(private User $user,
                                private UserRepository $userRepository,
                                private UserErrorHandler $userErrorHandler) {}

    public function listUser(?string $search, int $current_page): array
    {
        $total_records = $search ? $this->userRepository->countSearchUser($search) 
                                : $this->userRepository->countUser();

        $pagination = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page); // Calculate the total pages and the start page

        $users = $search ? $this->find($search, $pagination['start_from'], Paginator::RESULT_PER_PAGE) 
                        : $this->findAll($pagination['start_from'], Paginator::RESULT_PER_PAGE);

        return [
            'users' => $users,
            'current_page' => $current_page,
            'total_pages' => $pagination['total_pages'],
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }

    public function createUser(array $request): void
    {
        $this->user->setFirstName($request['first_name']);
        $this->user->setLastName($request['last_name']);
        $this->user->setEmail($request['email']);
        $this->user->setGender($request['gender']);
        $this->user->setPassword($request['password']);
        $this->user->setRoleId($request['role_id']);

        $this->userRepository->createUser();
    }

    public function updateUser(int $user_id, array $request): void
    {
        // Update user informations
        $this->user->setFirstName($request['first_name']);
        $this->user->setLastName($request['last_name']);
        $this->user->setEmail($request['email']);
        $this->user->setGender($request['gender']);
        $this->user->setRoleId($request['role_id']);

        $this->userRepository->updateUserById($user_id);
    }

    public function deleteUser(int $user_id): void
    {
        $this->userRepository->deleteUser($user_id);
    }

    public function handleError(array $request, $isUpdated = false): array
    {
        $errors = $this->handleUserError($request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }

    public function findById(int $user_id)
    {
        return $this->userRepository->getUserById($user_id);
    }

    private function findAll(int $start_from, int $result_per_page): array
    {
        return $this->userRepository->getAllUser($start_from, $result_per_page);
    }

    private function find(string $search, int $start_from, int $result_per_page): array
    {
        return $this->userRepository->searchUser($search, $start_from, $result_per_page);
    }

    private function handleUserError(array $request, bool $isUpdated): array
    {
        $errors = [];

        try {
            // Email exist error handling
            if (!$isUpdated && $this->userErrorHandler->isEmailExist($request['email'], $this->user)) {
                $errors['email-existed'] = 'Email already existed!';
            }

            // Email validate error handling
            if ($this->userErrorHandler->isEmailInvalid($request['email'])) {
                $errors['email-invalid'] = 'Invalid email!';
            }

            // Empty input handling
            if ($this->userErrorHandler->emptyInput($request['first_name'])) {
                $errors['empty-firstname'] = 'First name can not be empty!';
            }

            if ($this->userErrorHandler->emptyInput($request['last_name'])) {
                $errors['empty-lastname'] = 'Last name can not be empty!';
            }

            if ($this->userErrorHandler->emptyInput($request['email'])) {
                $errors['empty-email'] = 'Email can not be empty!';
            }

            if ($this->userErrorHandler->emptyInput($request['gender'])) {
                $errors['empty-gender'] = 'Gender can not be empty!';
            }

            if (!$isUpdated && $this->userErrorHandler->emptyInput($request['password'])) {
                $errors['empty-password'] = 'Password can not be empty!';
            }
        } catch (Exception $e) {
            $errors['exception-error'][] = $e->getMessage();
        }

        return $errors;
    }
}