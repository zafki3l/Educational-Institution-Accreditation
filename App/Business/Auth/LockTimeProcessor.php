<?php

namespace App\Business\Auth;

class LockTimeProcessor
{
    public const LOCK_TIME = 60;
    
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