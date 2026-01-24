<?php

namespace App\Business\Modules\RoleBasedAccess;

use App\Domain\Entities\Models\User;

class ShowHomepage extends RoleBasedAccess
{
    /**
     * @var array
     */
    protected const PERMISSIONS = [
        'show_homepage' => [
            User::ROLE_USER,
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