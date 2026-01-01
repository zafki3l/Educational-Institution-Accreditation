<?php

namespace App\Persistent\Repositories\Sql\User;

use App\Business\Ports\UserRepositoryInterface;
use App\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use App\Persistent\Repositories\Traits\QueryClauseHelper;
use Core\SqlRepository;
use PDOException;

class MySqlUserRepository extends SqlRepository implements UserRepositoryInterface
{
    use QueryClauseHelper;

    public function __construct(DatabaseInterface $db) 
    {
        parent::__construct($db);
    }

    public function all(int $start_from, int $result_per_page): array
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
                    ORDER BY u.id";
            $sql .= $this->bindLimitClause($start_from, $result_per_page);

            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function findByEmail(string $email): array
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

    public function findById(int $user_id): array
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

    public function create(array $user): int
    {
        try {
            return $this->insert('users', $user);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function updateById(array $user): int
    {
        try {
            $params = $user;

            $sql = "UPDATE users
                    SET first_name = ?,
                        last_name = ?,
                        email = ?,
                        gender = ?,
                        department_id = ?,
                        role_id = ?
                    WHERE id = ?";

            return $this->update($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function deleteById(int $user_id): int
    {
        try {
            $params = ['user_id' => $user_id];

            $sql = "DELETE FROM users WHERE id = ?";

            return $this->delete($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function search(mixed $search, $start_from, $result_per_page): array
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

    public function countAll(): int
    {
        try {
            $data = $this->getAll("SELECT COUNT(id) as 'total' FROM users");

            return $data[0]['total'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function countSearch(string $search): int
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