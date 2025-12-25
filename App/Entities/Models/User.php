<?php

namespace App\Entities\Models;

class User
{
    //Constants
    public const ROLE_USER = 1;
    public const ROLE_BUSINESS_STAFF = 2;
    public const ROLE_ADMIN = 3;

    public function __construct(private ?int $id,
                                private string $first_name,
                                private string $last_name,
                                private string $email,
                                private string $gender,
                                private ?string $password,
                                private int $department_id,
                                private int $role_id) {}

    public static function isAdmin(int $role_id): bool
    {
        return $role_id === self::ROLE_ADMIN;
    }

    public static function isStaff(int $role_id): bool
    {
        return in_array($role_id, [self::ROLE_BUSINESS_STAFF, self::ROLE_ADMIN]);
    }

    public function getId(): ?int {return $this->id;}

	public function getFirstName(): string {return $this->first_name;}

	public function getLastName(): string {return $this->last_name;}

	public function getEmail(): ?string {return $this->email;}

	public function getGender(): string {return $this->gender;}

	public function getPassword(): string {return $this->password;}

    public function getDepartmentId(): int {return $this->department_id;}

	public function getRoleId(): int {return $this->role_id;}
}
