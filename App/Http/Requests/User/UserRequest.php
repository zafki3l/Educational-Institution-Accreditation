<?php

namespace App\Http\Requests\User;

/**
 * Class AdminRequest
 * Get requests related to user
 */
abstract class UserRequest
{
    protected readonly string $first_name;
    protected readonly string $last_name;
    protected readonly string $email;
    protected readonly string $gender;
    protected readonly int $department_id;
    protected readonly int $role_id;

	public function getFirstName(): string {return $this->first_name;}

	public function getLastName(): string {return $this->last_name;}

	public function getEmail(): string {return $this->email;}

	public function getGender(): string {return $this->gender;}

	public function getDepartmentId(): int {return $this->department_id;}

	public function getRoleId(): int {return $this->role_id;}
}