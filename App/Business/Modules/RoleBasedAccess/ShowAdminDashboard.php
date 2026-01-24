<?php

namespace App\Business\Modules\RoleBasedAccess;

use App\Domain\Entities\Models\User;

class ShowAdminDashboard extends RoleBasedAccess
{
    /**
     * @var array
     */
    protected const PERMISSIONS = [
        'show_admin_dashboard' => [
            User::ROLE_ADMIN
        ]
    ];

    /**
     * @return string
     */
    public static function key(): string
    {
        return array_keys(self::PERMISSIONS)[0];
    }
}