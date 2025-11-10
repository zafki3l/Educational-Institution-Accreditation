<?php

namespace App\Database\Models;

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

    public static function isAdmin($role): bool
    {
        return $role === self::ROLE_ADMIN;
    }

    public static function isStaff($role): bool
    {
        return in_array($role, [self::ROLE_BUSINESS_STAFF, self::ROLE_ADMIN]);
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

	public function setId(string $id): void {$this->id = $id;}

	public function setFirstName(string $first_name): void {$this->first_name = $first_name;}

	public function setLastName(string $last_name): void {$this->last_name = $last_name;}

	public function setEmail(string $email): void {$this->email = $email;}

	public function setGender(string $gender): void {$this->gender = $gender;}

	public function setPassword(string $password): void {$this->password = $password;}

	public function setRoleId(int $role_id): void {$this->role_id = $role_id;}

	public function setCreatedAt(DateTime $created_at): void {$this->created_at = $created_at;}

	public function setUpdatedAt(DateTime $updated_at): void {$this->updated_at = $updated_at;}
}
