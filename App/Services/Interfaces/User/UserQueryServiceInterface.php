<?php

namespace App\Services\Interfaces\User;

use App\DTO\UserDTO\UserCollectionDTO;

/**
 * Application service responsible for querying user's data
 */
interface UserQueryServiceInterface
{
    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO;

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO;

    public function findOrFail(int $id): UserCollectionDTO;

    public function count(?string $search = null): int;
}