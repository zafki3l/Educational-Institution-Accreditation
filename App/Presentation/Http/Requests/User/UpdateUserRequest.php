<?php

namespace App\Presentation\Http\Requests\User;

class UpdateUserRequest extends UserRequest
{
    public function __construct(array $input)
    {
        $this->first_name = trim($input['first_name'] ?? '');
        $this->last_name = trim($input['last_name'] ?? '');
        $this->email = trim($input['email'] ?? '');
        $this->gender = trim($input['gender'] ?? '');
        $this->role_id = (int) ($input['role_id'] ?? 1);
        $this->department_id = (int) ($input['department_id'] ?? 0);
    }
}