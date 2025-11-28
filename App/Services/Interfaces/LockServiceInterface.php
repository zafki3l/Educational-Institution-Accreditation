<?php

namespace App\Services\Interfaces;

interface LockServiceInterface
{
    public static function isLocked(): bool;
}