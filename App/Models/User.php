<?php

namespace App\Models;

use DateTime;

class User
{
    //Constants
    public const ROLE_USER = 1;
    public const ROLE_BUSINESS_STAFF = 2;
    public const ROLE_ADMIN = 3;

    // Attributes
    private string $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $gender;
    private string $password;
    private int $role_id;
    private DateTime $created_at;
    private DateTime $updated_at;

    public static function isAdmin(int $role_id): bool
    {
        return $role_id === self::ROLE_ADMIN;
    }

    public static function isStaff(int $role_id): bool
    {
        return in_array($role_id, [self::ROLE_BUSINESS_STAFF, self::ROLE_ADMIN]);
    }

    public function getId(): string {return $this->id;}

	public function getFirstName(): string {return $this->first_name;}

	public function getLastName(): string {return $this->last_name;}

	public function getEmail(): string {return $this->email;}

	public function getGender(): string {return $this->gender;}

	public function getPassword(): string {return $this->password;}

	public function getRoleId(): int {return $this->role_id;}

	public function getCreatedAt(): DateTime {return $this->created_at;}

	public function getUpdatedAt(): DateTime {return $this->updated_at;}

	public function setId(string $id): self {$this->id = $id; return $this;}

	public function setFirstName(string $first_name): self {$this->first_name = $first_name; return $this;}

	public function setLastName(string $last_name): self {$this->last_name = $last_name; return $this;}

	public function setEmail(string $email): self {$this->email = $email; return $this;}

	public function setGender(string $gender): self {$this->gender = $gender; return $this;}

	public function setPassword(string $password): self {$this->password = $password; return $this;}

	public function setRoleId(int $role_id): self {$this->role_id = $role_id; return $this;}

	public function setCreatedAt(DateTime $created_at): self {$this->created_at = $created_at; return $this;}

	public function setUpdatedAt(DateTime $updated_at): self {$this->updated_at = $updated_at; return $this;}
}
