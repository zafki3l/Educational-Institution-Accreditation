<?php

namespace App\Business\Auth;

class SessionProcessor
{
    public static function generate(): bool
    {
        return session_status() == PHP_SESSION_NONE ? session_start() : true;
    }

    public function setUserSession(array $db_user): array
    {
        return [
            'user_id' => $db_user[0]['id'],
            'first_name' => $db_user[0]['first_name'],
            'last_name' => $db_user[0]['last_name'],
            'email' => $db_user[0]['email'],
            'gender' => $db_user[0]['gender'],
            'role_id' => $db_user[0]['role_id'],
            'department_id' => $db_user[0]['department_id']
        ];
    }
}