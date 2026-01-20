<?php 

namespace App\Business\RoleBasedAccess;

use App\Domain\Entities\Models\User;

class ShowStaffDashboard extends RoleBasedAccess
{
    protected const PERMISSIONS = [
        'show_staff_dashboard' => [
            User::ROLE_BUSINESS_STAFF,
            User::ROLE_ADMIN
        ]
    ];

    public static function key(): string
    {
        return array_keys(self::PERMISSIONS)[0];
    }
}