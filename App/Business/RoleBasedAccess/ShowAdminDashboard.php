<?php

namespace App\Business\RoleBasedAccess;

use App\Domain\Entities\Models\User;

class ShowAdminDashboard extends RoleBasedAccess
{
    protected const PERMISSIONS = [
        'show_admin_dashboard' => [
            User::ROLE_ADMIN
        ]
    ];

    public static function key(): string
    {
        return array_keys(self::PERMISSIONS)[0];
    }
}