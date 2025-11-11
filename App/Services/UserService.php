<?php

namespace App\Services;

use App\Database\Models\User;
use App\Database\Repositories\Interfaces\UserRepositoryInterface;
use Core\Paginator;
use ErrorHandlers\UserErrorHandler;
use Exception;

class UserService
{
    public function __construct(private User $user,
                                private UserRepositoryInterface $userRepository,
                                private UserErrorHandler $userErrorHandler) {}

    public function listUsers(?string $search, int $current_page): array
    {
        $total_records = $search ? $this->userRepository->countSearchUser($search) 
                                : $this->userRepository->countUser();

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $users = $search ? $this->find($search, $start_from, Paginator::RESULT_PER_PAGE) 
                        : $this->findAll($start_from, Paginator::RESULT_PER_PAGE);

        return [
            'users' => $users,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }

    public function createUser(array $request): void
    {
        $this->user->setFirstName($request['first_name'])
                    ->setLastName($request['last_name'])
                    ->setEmail($request['email'])
                    ->setGender($request['gender'])
                    ->setPassword($request['password'])
                    ->setRoleId($request['role_id']);

        $this->userRepository->createUser($this->user);
    }

    public function updateUser(int $user_id, array $request): void
    {
        // Update user informations
        $this->user->setFirstName($request['first_name'])
                    ->setLastName($request['last_name'])
                    ->setEmail($request['email'])
                    ->setGender($request['gender'])
                    ->setRoleId($request['role_id']);

        $this->userRepository->updateUserById($user_id, $this->user);
    }

    public function deleteUser(int $user_id): void
    {
        $this->userRepository->deleteUser($user_id);
    }

    public function handleError(array $request, $isUpdated = false): ?array
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
            if (!$isUpdated && $this->userErrorHandler->isEmailExist($request['email'], $this->userRepository)) {
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