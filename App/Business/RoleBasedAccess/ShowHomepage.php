<?php

namespace App\Business\RoleBasedAccess;

use App\Domain\Entities\Models\User;

class ShowHomepage extends RoleBasedAccess
{
    protected const PERMISSIONS = [
        'show_homepage' => [
            User::ROLE_USER,
            User::ROLE_BUSINESS_STAFF,
            User::ROLE_ADMIN
        ]
    ];

    public static function key(): string
    {
        return 'show_homepage';
    }
}