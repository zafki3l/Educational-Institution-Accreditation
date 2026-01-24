<?php

namespace App\Business\Modules\Auth;

class SessionProcessor
{
    /**
     * Regenerate session if it isn't active
     * @return bool
     */
    public static function generate(): bool
    {
        return session_status() == PHP_SESSION_NONE ? session_start() : true;
    }

    /**
     * Set the login user when they are successfully log-in
     * @param array $db_user
     * @return array{department_id: mixed, email: mixed, first_name: mixed, gender: mixed, last_name: mixed, role_id: mixed, user_id: mixed}
     */
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