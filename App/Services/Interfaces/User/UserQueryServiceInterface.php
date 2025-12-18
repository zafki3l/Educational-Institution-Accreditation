<?php

namespace App\Services\Interfaces\User;

use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;

interface UserQueryServiceInterface
{
    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO;

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO;

    public function findById(int $id): UserByIdDTO;

    public function count(?string $search = null): int;
}