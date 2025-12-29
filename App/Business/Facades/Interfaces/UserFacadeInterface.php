<?php

namespace App\Business\Facades\Interfaces;

use App\Domain\Entities\DataTransferObjects\UserDTO\UserByIdDTO;
use App\Domain\Entities\DataTransferObjects\UserDTO\UserCollectionDTO;
use App\Presentation\Http\Requests\User\CreateUserRequest;
use App\Presentation\Http\Requests\User\UpdateUserRequest;
use App\Presentation\Http\Requests\User\UserRequest;
use MongoDB\InsertOneResult;

interface UserFacadeInterface
{
    public function list(?string $search, int $current_page): array;

    public function create(CreateUserRequest $request): void;

    public function update(int $id, UpdateUserRequest $request): void;

    public function delete(int $id): void;

    public function handleError(UserRequest $request, $isUpdated = false): ?array;

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO;

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO;

    public function findOrFail(int $id): UserByIdDTO;

    public function count(?string $search = null): int;
}