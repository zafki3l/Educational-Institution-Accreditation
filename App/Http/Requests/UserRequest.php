<?php

namespace App\Http\Requests;

/**
 * Class AdminRequest
 * Get requests related to user
 */
class UserRequest
{
    public function addUserRequest(): array
    {
        return [
            'first_name' => trim($_POST['first_name']) ?? '',
            'last_name' => trim($_POST['last_name']) ?? '',
            'email' => trim($_POST['email']) ?? '',
            'gender' => trim($_POST['gender']) ?? '',
            'password' => trim($_POST['password']) ?? '',
            'role_id' => trim($_POST['role_id']) ?? 1
        ];
    }

    public function updateUserRequest(): array
    {
        return [
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'gender' => trim($_POST['gender']),
            'role_id' => trim($_POST['role_id'])
        ];
    }
}
