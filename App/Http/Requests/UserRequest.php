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
            'street' => trim($_POST['street']) ?? '',
            'city' => trim($_POST['city']) ?? '',
            'password' => trim($_POST['password']) ?? '',
            'role' => trim($_POST['role']) ?? 1
        ];
    }

    public function updateUserRequest(): array
    {
        return [
            'address_id' => trim($_POST['address_id']),
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'gender' => trim($_POST['gender']),
            'street' => trim($_POST['street']),
            'city' => trim($_POST['city']),
            'role' => trim($_POST['role'])
        ];
    }

    public function deleteUserRequest(): array
    {
        return [
            'user_id' => trim($_POST['user_id']),
            'address_id' => trim($_POST['address_id'])
        ];
    }
}
