<?php

namespace App\Services\Implementations\User;

use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\LogServiceInterface;
use App\Services\Interfaces\User\UserCommandServiceInterface;
use App\Services\Interfaces\User\UserQueryServiceInterface;
use App\Services\Interfaces\User\UserServiceInterface;
use App\Validations\Interfaces\UserValidatorInterface;
use Core\Paginator;

class UserService implements UserServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository,
                                private UserQueryServiceInterface $userQueryService,
                                private UserCommandServiceInterface $userCommandService,
                                private UserValidatorInterface $userValidator,
                                private LogServiceInterface $logService) {}

    public function list(?string $search, int $current_page): array
    {
        $total_records = $this->userQueryService->count($search);

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $users = $search ? $this->userQueryService->find($search, $start_from, Paginator::RESULT_PER_PAGE) 
                        : $this->userQueryService->findAll($start_from, Paginator::RESULT_PER_PAGE);

        return [
            'users' => $users->toArray(),
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }

    public function create(CreateUserRequest $request): void
    {
        $created = $this->userCommandService->create($request);

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm người dùng mới";

        $this->logService->createLog('user', $created['data'], 'create', $message, $created['isSuccess']);
    }

    public function update(int $id, UpdateUserRequest $request): void
    {
        $updated = $this->userCommandService->update($id, $request);
        $data = $updated['data'];

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã chỉnh sửa thông tin người dùng {$data['id']}";

        $this->logService->createLog('user', $data, 'update', $message, $updated['isSuccess']);   
    }

    public function delete(int $id): void
    {
        $deleted = $this->userCommandService->delete($id);
        $data = $deleted['data'];

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa người dùng {$data['id']}";

        $this->logService->createLog('user', $data, 'delete', $message, $deleted['isSuccess']);
    }

    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        $errors = $this->userValidator->handleUserError($this->userRepository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        return $this->userQueryService->findAll($start_from, $result_per_page);   
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        return $this->userQueryService->find($search, $start_from, $result_per_page);
    }

    public function findById(int $id): UserByIdDTO
    {
        return $this->userQueryService->findById($id);
    }

    public function count(?string $search = null): int
    {
        return $this->userQueryService->count($search);
    }
}