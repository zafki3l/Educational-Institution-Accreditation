<?php

namespace App\Services\Implementations;

use App\Exceptions\UserException\UserNotFoundException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Validations\Interfaces\UserValidatorInterface;
use Core\Paginator;

class UserService implements UserServiceInterface
{
    public function __construct(private User $user,
                                private UserRepositoryInterface $userRepository,
                                private UserValidatorInterface $userValidator) {}

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
        $errors = $this->userValidator->handleUserError($this->userRepository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }

    public function findById(int $user_id): array
    {
        $user = $this->userRepository->getUserById($user_id);

        if (!$user) {
            throw new UserNotFoundException($user_id);
        }

        return $user;
    }

    public function findAll(int $start_from, int $result_per_page): array
    {
        return $this->userRepository->getAllUser($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): array
    {
        return $this->userRepository->searchUser($search, $start_from, $result_per_page);
    }
}