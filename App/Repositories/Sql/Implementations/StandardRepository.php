<?php 

namespace App\Repositories\Sql\Implementations;

use App\Models\Standard;
use App\Repositories\Sql\Interfaces\StandardRepositoryInterface;
use Configs\Database\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;

class StandardRepository extends SqlRepository implements StandardRepositoryInterface
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function all(): array
    {
        try {
            return $this->getAll("SELECT id, name FROM evaluation_standards");
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function allWithDepartment(): array
    {
        try {
            return $this->getAll(
                "SELECT es.id as 'id', 
                        es.name as 'name', 
                        d.name as 'department_name' 
                FROM evaluation_standards es
                JOIN departments d 
                    ON d.id = es.department_id");
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function create(array $standard): int
    {
        try {
            return $this->insert('evaluation_standards', $standard);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function findById(string $standard_id): array
    {
        try {
            return $this->getByParams([$standard_id], "SELECT id FROM evaluation_standards WHERE id = ?");
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function deleteById(string $standard_id): int
    {
        try {
            return $this->delete("DELETE FROM evaluation_standards WHERE id = ?", [$standard_id]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function countAll(): int
    {
        try {
            $results = $this->getAll("SELECT count(id) as 'results' from evaluation_standards");
            return $results[0]['results'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }
}