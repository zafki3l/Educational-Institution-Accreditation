<?php 

namespace App\Persistent\Repositories\Sql\Criteria;

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use App\Persistent\Repositories\Traits\QueryClauseHelper;
use Core\SqlRepository;
use PDOException;

class MySqlCriteriaRepository extends SqlRepository implements CriteriaRepositoryInterface
{
    use QueryClauseHelper;

    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function all(): array
    {
        try {
            $sql = "SELECT id, standard_id, name FROM evaluation_standards";
            
            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function allWithDepartment(): array
    {
        try {
            $sql = "SELECT ec.id as 'criteria_id',
                            es.name as 'standard_name',
                            ec.name as 'criteria_name',
                            d.name as 'department_name',
                            ec.created_at,
                            ec.updated_at
                    FROM evaluation_criterias ec
                    JOIN evaluation_standards es
                        ON ec.standard_id = es.id
                    JOIN departments d 
                        ON es.department_id = d.id";
            
            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function findById(string $criteria_id): array
    {
        try {
            $sql = "SELECT * FROM evaluation_criterias WHERE id = ?"; 

            return $this->getByParams([$criteria_id], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function filter(array $filter): array
    {
        try {
            $columns = [
                'standard_id' => 'es.id',
                'department_id' => 'd.id'
            ];

            $clause = $this->buildWhereClause($filter, $columns);

            $sql = "SELECT ec.id as 'criteria_id',
                            es.name as 'standard_name',
                            ec.name as 'criteria_name',
                            d.name as 'department_name',
                            ec.created_at,
                            ec.updated_at
                    FROM evaluation_criterias ec
                    JOIN evaluation_standards es
                        ON ec.standard_id = es.id
                    JOIN departments d 
                        ON es.department_id = d.id";
            $sql .= $this->bindWhereClause($clause['where']);
            
            return $this->getByParams($clause['params'], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function countAll(): int
    {
        try {
            $data = $this->getAll("SELECT COUNT(id) as 'total' FROM evaluation_criterias");

            return $data[0]['total'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function create(array $criteria): int
    {
        try {
            return $this->insert('evaluation_criterias', $criteria);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function deleteById(string $id): int
    {
        try {
            return $this->delete("DELETE FROM evaluation_criterias WHERE id = ?", [$id]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function search(string $search): array
    {
        // TODO:
        return [];
    }

    public function countSearch(string $search): int
    {
        // TODO:
        return 0;
    }
}