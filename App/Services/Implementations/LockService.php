<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\LockServiceInterface;

class LockService implements LockServiceInterface
{
    public static function isLocked(): bool
    {
        $isLocked = time() < $_SESSION['lock_time'];
        if ($isLocked) {
            $remain = $_SESSION['lock_time'] - time();
            $_SESSION['locked'] = "Too many failed attempts. Please try again after {$remain} seconds.";

            return true;
        }
        
        return false;
    }
}