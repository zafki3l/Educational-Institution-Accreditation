<?php 

namespace App\Services\Interfaces;

interface StandardServiceInterface
{
    public function list(): array;
    public function findAll(): array;
    public function create(array $request): void;
    public function delete(string $id): void;
}