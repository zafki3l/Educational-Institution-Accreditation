<?php

namespace App\Services\Interfaces;

interface CriteriaServiceInterface
{
    public function listCriterias(?string $search, int $current_page): array;

    public function findAll(int $start_from, int $result_per_page): array;
    public function find(string $search, int $start_from, int $result_per_page): array;
}

?>