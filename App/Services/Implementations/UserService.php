<?php

namespace App\Services\Implementations;

use App\Exceptions\UserException\UserNotFoundException;
use App\Models\User;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\LogServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Validations\Interfaces\UserValidatorInterface;
use Core\Paginator;

class UserService implements UserServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository,
                                private UserValidatorInterface $userValidator,
                                private LogServiceInterface $logService) {}

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

        $user_id = $this->userRepository->create($user);

        $found = $this->findById($user_id);

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm người dùng mới";

        $this->logService->createLogUser($found, 'create', $message);
    }

    public function update(int $user_id, array $request): void
    {
        $found = $this->findById($user_id);

        $user = new User();

        $user->setFirstName($request['first_name'])
            ->setLastName($request['last_name'])
            ->setEmail($request['email'])
            ->setGender($request['gender'])
            ->setDepartmentId($request['department_id'])
            ->setRoleId($request['role_id']);

        $this->userRepository->updateById($user_id, $user);

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã chỉnh sửa thông tin người dùng {$found['id']}";

        $this->logService->createLogUser($found, 'update', $message);
    }

    public function delete(int $user_id): void
    {
        $found = $this->findById($user_id);

        $this->userRepository->deleteById($user_id);

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa người dùng {$found['id']}";

        $this->logService->createLogUser($found, 'delete', $message);
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

        return [
            'id' => $found[0]['id'],
            'first_name' => $found[0]['first_name'],
            'last_name' => $found[0]['last_name'],
            'email' => $found[0]['email'],
            'gender' => $found[0]['gender'],
            'role_id' => $found[0]['role_id'],
            'department_id' => $found[0]['department_id']
        ];
    }

    public function findAll(int $start_from, int $result_per_page): array
    {
        return $this->userRepository->all($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): array
    {
        return $this->userRepository->search($search, $start_from, $result_per_page);
    }

    // Have to count the total records in order to calculate pagination
    public function count(?string $search = null): int
    {
        return $search ? $this->userRepository->countSearch($search) 
                        : $this->userRepository->countAll();
    }
}