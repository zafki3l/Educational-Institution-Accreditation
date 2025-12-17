<?php

namespace App\Services\Implementations;

use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;
use App\DTO\UserDTO\UserListDTO;
use App\Exceptions\UserException\UserNotFoundException;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\LogServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Validations\Interfaces\UserValidatorInterface;
use Core\Paginator;
use DateTimeImmutable;

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
            'users' => $users->toArray(),
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }

    public function create(CreateUserRequest $request): void
    {
        $user = new User();

        $user->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setEmail($request->getEmail())
            ->setGender($request->getGender())
            ->setPassword($request->getPassword())
            ->setDepartmentId($request->getDepartmentId())
            ->setRoleId($request->getDepartmentId());

        $created = $this->userRepository->create([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'department_id' => $user->getDepartmentId(),
            'role_id' => $user->getRoleId()
        ]);

        $found = $this->findById($created);

        $isSuccess = $created ? true : false;

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm người dùng mới";

        $this->logService->createLog('user', $found, 'create', $message, $isSuccess);
    }

    public function update(int $user_id, UpdateUserRequest $request): void
    {
        $found = $this->findById($user_id);

        $data = $found->toArray();

        $user = new User();

        $user->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setEmail($request->getEmail())
            ->setGender($request->getGender())
            ->setDepartmentId($request->getDepartmentId())
            ->setRoleId($request->getRoleId());

        $updated = $this->userRepository->updateById([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'department_id' => $user->getDepartmentId(),
            'role_id' => $user->getRoleId(),
            'user_id' => $user_id
        ]);

        $isSuccess = $updated ? true : false;

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã chỉnh sửa thông tin người dùng {$data['id']}";

        $this->logService->createLog('user', $data, 'update', $message, $isSuccess);
    }

    public function delete(int $user_id): void
    {
        $found = $this->findById($user_id);

        $data = $found->toArray();

        $deleted = $this->userRepository->deleteById($user_id);

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa người dùng {$data['id']}";

        $isSuccess = $deleted ? true : false;

        $this->logService->createLog('user', $data, 'delete', $message, $isSuccess);
    }

    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        $request = !$isUpdated ? new CreateUserRequest($_POST) : new UpdateUserRequest($_POST); 
        $errors = $this->userValidator->handleUserError($this->userRepository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }

    public function findById(int $user_id): UserByIdDTO
    {
        $found = $this->userRepository->findById($user_id);

        if (!$found) {
            throw new UserNotFoundException($user_id);
        }

        return new UserByIdDTO(
            $found[0]['id'],
            $found[0]['first_name'],
            $found[0]['last_name'],
            $found[0]['email'],
            $found[0]['gender'],
            $found[0]['role_id'],
            $found[0]['department_id']
        );
    }

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->userRepository->all($start_from, $result_per_page);

        $userCollection = new UserCollectionDTO();

        foreach ($users as $userDto) {
            $userCollection->append(new UserListDTO(
                $userDto['id'],
                $userDto['first_name'],
                $userDto['last_name'],
                $userDto['email'],
                $userDto['gender'],
                $userDto['department_name'],
                $userDto['role_name'],
                new DateTimeImmutable($userDto['created_at']),
                new DateTimeImmutable($userDto['updated_at'])
            ));
        }

        return $userCollection;
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->userRepository->search($search, $start_from, $result_per_page);

        $userCollection = new UserCollectionDTO();

        foreach ($users as $userDto) {
            $userCollection->append(new UserListDTO(
                $userDto['id'],
                $userDto['first_name'],
                $userDto['last_name'],
                $userDto['email'],
                $userDto['gender'],
                $userDto['department_name'],
                $userDto['role_name'],
                new DateTimeImmutable($userDto['created_at']),
                new DateTimeImmutable($userDto['updated_at'])
            ));
        }

        return $userCollection;
    }

    // Have to count the total records in order to calculate pagination
    public function count(?string $search = null): int
    {
        return $search 
            ? $this->userRepository->countSearch($search) 
            : $this->userRepository->countAll();
    }
}