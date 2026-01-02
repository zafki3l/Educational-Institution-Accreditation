<?php

namespace App\Domain\Entities\Builders;

use App\Domain\Entities\Models\User;

class UserBuilder
{
    //Constants
    public const ROLE_USER = 1;
    public const ROLE_BUSINESS_STAFF = 2;
    public const ROLE_ADMIN = 3;

    // Attributes
    private ?int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $gender;
    private ?string $password;
    private int $department_id;
    private int $role_id;

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setDepartmentId(int $department_id): self
    {
        $this->department_id = $department_id;
        return $this;
    }

    public function setRoleId(int $role_id): self
    {
        $this->role_id = $role_id;
        return $this;
    }

    public function build(): User
    {
        return new User(
            $this->id,
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->gender,
            $this->password,
            $this->department_id,
            $this->role_id
        );
    }
}
