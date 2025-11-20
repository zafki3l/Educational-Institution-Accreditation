<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;
use Core\Repository;
use PDOException;

class UserRepository extends Repository implements UserRepositoryInterface
{
    public function __construct(DatabaseInterface $db) 
    {
        parent::__construct($db);
    }

    public function getAllUser(int $start_from, int $result_per_page): array
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

    public function createUser(User $user): int
    {
        try {
            return $this->insert('users', [
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'gender' => $user->getGender(),
                'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                'department_id' => $user->getDepartmentId(),
                'role_id' => $user->getRoleId()
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function updateUserById(int $user_id, User $user): void
    {
        try {
            $params = [
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'gender' => $user->getGender(),
                'department_id' => $user->getDepartmentId(),
                'role_id' => $user->getRoleId(),
                'user_id' => $user_id
            ];

            $sql = "UPDATE users
                    SET first_name = ?,
                        last_name = ?,
                        email = ?,
                        gender = ?,
                        department_id = ?,
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
}