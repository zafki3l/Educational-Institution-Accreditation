<?php

namespace App\Models;

use Core\Model;
use Configs\Database;
use PDOException;
use DateTime;

class User extends Model
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

    // Constructor
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function getAllUser($start_from, $result_per_page): array
    {
        try {
            $sql = "SELECT u.id as 'id',
                            u.first_name,
                            u.last_name,
                            u.email,
                            u.gender,
                            d.name as 'department_name',
                            r.name as 'role_name',
                            u.created_at,
                            u.updated_at
                    FROM users u
                    JOIN roles r ON r.id = u.role_id
                    LEFT JOIN departments d ON d.id = u.department_id
                    ORDER BY u.id
                    LIMIT $start_from, $result_per_page";

            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function getUserByEmail(string $email): array
    {
        try {
            $sql = "SELECT * FROM users
                    WHERE email = ?";
            return $this->getByParams([$email], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function getUserById(int $user_id): array
    {
        try {
            $sql = "SELECT * FROM users
                    WHERE id = ?";

            return $this->getByParams([$user_id], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function createUser(): int
    {
        try {
            return $this->insert('users', [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'gender' => $this->gender,
                'password' => password_hash($this->password, PASSWORD_DEFAULT),
                'role_id' => $this->role_id
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function updateUserById(int $user_id): void
    {
        try {
            $params = [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'gender' => $this->gender,
                'role_id' => $this->role_id,
                'user_id' => $user_id
            ];

            $sql = "UPDATE users
                    SET first_name = ?,
                        last_name = ?,
                        email = ?,
                        gender = ?,
                        role_id = ?
                    WHERE id = ?";

            $this->update($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function deleteUser(int $user_id): void
    {
        try {
            $params = ['user_id' => $user_id];

            $sql = "DELETE FROM users WHERE id = ?";

            $this->delete($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function searchUser(mixed $search, $start_from, $result_per_page): array
    {
        try {
            $data = "%$search%";

            $sql = "SELECT u.id as 'id',
                            u.first_name,
                            u.last_name,
                            u.email,
                            u.gender,
                            d.name as 'department_name',
                            r.name as 'role_name',
                            u.created_at,
                            u.updated_at
                    FROM users u
                    JOIN roles r ON r.id = u.role_id
                    LEFT JOIN departments d ON d.id = u.department_id
                    WHERE u.id = ? 
                        OR u.first_name LIKE ?
                        OR u.last_name LIKE ?
                    ORDER BY u.id
                    LIMIT $start_from, $result_per_page";

            $params = [$data, $data, $data];

            return $this->getByParams($params, $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function countUser(): int
    {
        try {
            $data = $this->getAll("SELECT COUNT(id) as 'total' FROM users");

            return $data[0]['total'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function countSearchUser(string $search): int
    {
        try {
            $data = "%$search%";

            $sql = "SELECT COUNT(id) as 'total'
                    FROM users
                    WHERE id = ? 
                        OR first_name LIKE ?
                        OR last_name LIKE ?";

            $params = [$data, $data, $data];
            
            $data = $this->getByParams($params, $sql);
            $total_records = $data[0]['total'];

            return $total_records;
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

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
