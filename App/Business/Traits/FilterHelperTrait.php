<?php

namespace App\Business\Traits;

trait FilterHelper
{
    public function filterArray(array $filter): array
    {
        // Return true values only
        return array_filter($filter, fn($value) => !empty($value));
    }
}