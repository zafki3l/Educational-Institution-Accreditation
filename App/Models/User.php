<?php

namespace App\Models;

use Core\Model;
use Configs\Database;
use PDOException;
use DateTime;
use Traits\ModelTrait;

class User extends Model
{
    use ModelTrait;

    //Constants
    const ROLE_GUEST = 0;
    const ROLE_USER = 1;
    const ROLE_STAFF = 2;
    const ROLE_ADMIN = 3;

    // Attributes
    private int $user_id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $gender;
    private string $password;
    private int $role;
    private DateTime $created_at;
    private DateTime $updated_at;

    // Constructor
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    /**
     * Get all user
     * @return array
     */
    public function getAllUser($start_from, $result_per_page): array
    {
        $sql = "SELECT *, COUNT(*) OVER() as 'total_count'
                FROM users_address ua
                JOIN users u ON ua.user_id = u.id
                JOIN address a ON ua.address_id = a.id
                LIMIT $start_from, $result_per_page";

        try {
            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    /**
     * Get user by email
     * @param string $email
     * @return array
     */
    public function getUserByEmail(string $email): array
    {
        $params = [$email];
        $sql = "SELECT u.id as 'user_id',
                        a.id as 'address_id',
                        u.first_name as 'first_name',
                        u.last_name as 'last_name',
                        u.email as 'email',
                        u.gender as 'gender',
                        a.street as 'street',
                        a.city as 'city',
                        u.password as 'password',
                        u.role as 'role'
                FROM users_address ua
                JOIN users u ON ua.user_id = u.id
                JOIN address a ON ua.address_id = a.id
                WHERE email = ?";

        try {
            return $this->getByParams($params, $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    /**
     * Get user by id
     * @param int $user_id
     * @return array
     */
    public function getUserById(int $user_id): array
    {
        $params = [$user_id];
        $sql = "SELECT u.id as 'user_id',
                        a.id as 'address_id',
                        u.first_name as 'first_name',
                        u.last_name as 'last_name',
                        u.email as 'email',
                        u.gender as 'gender',
                        a.street as 'street',
                        a.city as 'city',
                        u.role as 'role'
                FROM users_address ua
                JOIN users u ON ua.user_id = u.id
                JOIN address a ON ua.address_id = a.id
                WHERE u.id = ?";

        try {
            return $this->getByParams($params, $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    /**
     * Create a user
     * @return bool|int|string
     */
    public function createUser(): int
    {
        try {
            return $this->insert('users', [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'gender' => $this->gender,
                'password' => password_hash($this->password, PASSWORD_DEFAULT),
                'role' => $this->role
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    /**
     * Link user to address
     * @param int $user_id
     * @param int $address_id
     * @return bool|int|string
     */
    public function linkAddress(int $user_id, int $address_id): int
    {
        try {
            return $this->insert('users_address', [
                'user_id' => $user_id,
                'address_id' => $address_id
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    /**
     * Update user by id
     * @param int $user_id
     * @return void
     */
    public function updateUserById(int $user_id): void
    {
        $params = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'role' => $this->role,
            'user_id' => $user_id
        ];

        $sql = "UPDATE users
                SET first_name = ?,
                    last_name = ?,
                    email = ?,
                    gender = ?,
                    role = ?
                WHERE id = ?";

        try {
            $this->update($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * delete User 
     * @param int $user_id
     * @return void
     */
    public function deleteUser(int $user_id): void
    {
        $params = ['user_id' => $user_id];

        $sql = "DELETE FROM users WHERE id = ?";

        try {
            $this->delete($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * Unlink User and Address relationship
     * @param mixed $user_id
     * @param mixed $address_id
     * @return void
     */
    public function unlinkUserAndAddress($user_id, $address_id): void
    {
        $params = [
            'user_id' => $user_id,
            'address_id' => $address_id
        ];

        $sql = "DELETE FROM users_address WHERE user_id = ? AND address_id = ?";

        try {
            $this->delete($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * Search users
     * 
     * @param mixed $search
     * @return array
     */
    public function searchUser(mixed $search, $start_from, $result_per_page): array
    {
        $data = "%$search%";

        $sql = "SELECT u.id as 'user_id',
                        a.id as 'address_id',
                        u.first_name as 'first_name',
                        u.last_name as 'last_name',
                        u.email as 'email',
                        u.gender as 'gender',
                        a.street as 'street',
                        a.city as 'city',
                        u.role as 'role',
                        u.created_at as 'created_at',
                        u.updated_at as 'updated_at'
                FROM users_address ua
                JOIN users u ON ua.user_id = u.id
                JOIN address a ON ua.address_id = a.id
                WHERE u.id = ? 
                    OR u.first_name LIKE ?
                    OR u.last_name LIKE ?
                    OR a.street LIKE ?
                    OR a.city LIKE ?
                LIMIT $start_from, $result_per_page";

        $params = [$data, $data, $data, $data, $data];

        try {
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
        $data = "%$search%";

        $sql = "SELECT COUNT(u.id) as 'total'
                FROM users_address ua
                JOIN users u ON ua.user_id = u.id
                JOIN address a ON ua.address_id = a.id
                WHERE u.id = ? 
                    OR u.first_name LIKE ?
                    OR u.last_name LIKE ?
                    OR a.street LIKE ?
                    OR a.city LIKE ?";

        $params = [$data, $data, $data, $data, $data];

        try {
            $data = $this->getByParams($params, $sql);
            $total_records = $data[0]['total'];

            return $total_records;
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }
}
