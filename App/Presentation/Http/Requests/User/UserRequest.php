<?php

namespace App\Presentation\Http\Requests\User;

/**
 * Class AdminRequest
 * Get requests related to user
 */
abstract class UserRequest
{
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $gender;
    protected int $department_id;
    protected int $role_id;

	public function getFirstName(): string {return $this->first_name;}

	public function getLastName(): string {return $this->last_name;}

	public function getEmail(): string {return $this->email;}

	public function getGender(): string {return $this->gender;}

	public function getDepartmentId(): int {return $this->department_id;}

	public function getRoleId(): int {return $this->role_id;}
}