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
    public function __construct(private UserRepositoryInterface $userRepository,
                                private UserValidatorInterface $userValidator) {}

    public function list(?string $search, int $current_page): array
    {
        $total_records = $this->count($search);

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

    public function create(array $request): void
    {
        $user = new User();

        $user->setFirstName($request['first_name'])
            ->setLastName($request['last_name'])
            ->setEmail($request['email'])
            ->setGender($request['gender'])
            ->setPassword($request['password'])
            ->setDepartmentId($request['department_id'])
            ->setRoleId($request['role_id']);

        $this->userRepository->create($user);
    }

    public function update(int $user_id, array $request): void
    {
        $user = new User();

        $user->setFirstName($request['first_name'])
            ->setLastName($request['last_name'])
            ->setEmail($request['email'])
            ->setGender($request['gender'])
            ->setDepartmentId($request['department_id'])
            ->setRoleId($request['role_id']);

        $this->userRepository->updateById($user_id, $user);
    }

    public function delete(int $user_id): void
    {
        $this->userRepository->deleteById($user_id);
    }

    public function handleError(array $request, $isUpdated = false): ?array
    {
        $errors = $this->userValidator->handleUserError($this->userRepository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }

    public function findById(int $user_id): array
    {
        $found = $this->userRepository->findById($user_id);

        if (!$found) {
            throw new UserNotFoundException($user_id);
        }

        return $found;
    }

    public function findAll(int $start_from, int $result_per_page): array
    {
        return $this->userRepository->all($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): array
    {
        return $this->userRepository->search($search, $start_from, $result_per_page);
    }

    private function count(?string $search): int
    {
        return $search ? $this->userRepository->countSearch($search) 
                        : $this->userRepository->countAll();
    }
}