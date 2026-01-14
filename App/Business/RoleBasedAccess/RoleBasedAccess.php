<?php

namespace App\Business\RoleBasedAccess;

abstract class RoleBasedAccess
{
    protected const PERMISSIONS = [];

    abstract public static function key(): string;

    public static function can($role_id): bool
    {
        return in_array($role_id, static::PERMISSIONS[static::key()] ?? []);
    }
}
