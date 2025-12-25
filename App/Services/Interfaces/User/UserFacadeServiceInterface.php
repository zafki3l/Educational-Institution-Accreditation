<?php

namespace App\Services\Interfaces\User;

use App\DTO\UserDTO\UserCollectionDTO;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use MongoDB\InsertOneResult;

/**
 *
 * High-level application service responsible for orchestrating
 * user-related use cases.
 *
 * This service acts as a Facade:
 * - Coordinates Query Services and Command Services
 * - Delegates logging and error handling to dedicated services
 * - Encapsulates complex workflows into simple public methods
 *
 * It hides internal business logic and interaction details from
 * controllers, providing a clean and stable interface for the
 * presentation layer.
 *
 * The Facade does NOT contain business rules or persistence logic.
 * Its sole responsibility is orchestration and flow control.
 */
interface UserFacadeServiceInterface
{
    public function list(?string $search, int $current_page): array;
    
    public function create(CreateUserRequest $request): InsertOneResult;
    
    public function update(int $user_id, UpdateUserRequest $request): InsertOneResult;
    
    public function delete(int $user_id): InsertOneResult;
    
    public function handleError(UserRequest $request, $isUpdated = false): ?array;

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO;

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO;

    public function findOrFail(int $id): UserCollectionDTO;

    public function count(?string $search = null): int;
}