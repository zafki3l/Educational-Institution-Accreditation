<?php

namespace App\Business\Modules\RoleBasedAccess;

/**
 * To provide a consistent "Gatekeeper" template. 
 * Instead of writing custom "if/else" logic for every page or action, 
 * this base class forces every permission check to follow the same 
 * structure, making the security layer predictable and easy to audit.
 */
abstract class RoleBasedAccess
{
    /**
     * A centralized map of "Who is allowed to do what."
     * 
     * @var array
     */
    protected const PERMISSIONS = [];

    /**
     * WHY: To enforce a unique identifier for every permission check.
     * Each child class (e.g., ShowAdminDashboard) must define its own key, 
     * which prevents different permissions from accidentally overlapping.
     * 
     * @return void
     */
    abstract public static function key(): string;

    /**
     * To provide a clean, readable API for the rest of the app.
     * It allows you to call `DeleteUserAccess::can($role_id)` anywhere. 
     * It uses late static binding (`static::`) so that it always 
     * looks at the permissions of the specific child class being called.
     * 
     * @param mixed $role_id
     * @return bool
     */
    public static function can($role_id): bool
    {
        return in_array($role_id, static::PERMISSIONS[static::key()] ?? []);
    }
}
