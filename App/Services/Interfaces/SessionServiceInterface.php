<?php

namespace App\Services\Interfaces;

interface SessionServiceInterface
{
    public function setUserSession(array $db_user): array;
}