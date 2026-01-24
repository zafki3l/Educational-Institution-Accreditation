<?php 

namespace App\Business\Modules\RoleBasedAccess;

use App\Domain\Entities\Models\User;

class ShowStaffDashboard extends RoleBasedAccess
{
    /**
     * @var array
     */
    protected const PERMISSIONS = [
        'show_staff_dashboard' => [
            User::ROLE_BUSINESS_STAFF,
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