<?php

namespace App\Services\Interfaces;

interface CriteriaServiceInterface
{
    public function listCriterias(?string $search, string $standard_id): array;
    public function createCriteria(array $request): void;
    public function deleteCriteria(string $id): void;
    public function findByStandard(string $standard_id): array;
    public function findAll(): array;
    public function find(?string $search): array;
}