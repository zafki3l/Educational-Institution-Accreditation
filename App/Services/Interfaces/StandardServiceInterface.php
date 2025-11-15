<?php 

namespace App\Services\Interfaces;

interface StandardServiceInterface
{
    public function listStandards(): array;
    public function findAll(): array;
    public function createStandard(array $request): void;
    public function deleteStandard(string $id): void;
}