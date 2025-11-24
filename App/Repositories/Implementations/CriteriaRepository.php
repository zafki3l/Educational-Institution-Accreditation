<?php 

namespace App\Repositories\Implementations;

use App\Models\Criteria;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;
use Core\Repository;
use PDOException;

class CriteriaRepository extends Repository implements CriteriaRepositoryInterface
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function getAllCriteria(): array
    {
        try {
            $sql = "SELECT id, standard_id, name FROM evaluation_standards";
            
            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function getAllCriteriaWithDepartment(): array
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

    public function getCriteriasByStandard(array $filter): array
    {
        try {
            $where = [];
            $params = [];

            $columns = [
                'standard_id' => 'es.id',
                'department_id' => 'd.id'
            ];

            foreach ($filter as $key => $value) {
                if (!empty($value)) {
                    $where[] = $columns[$key] . ' = ? ';
                    $params[] = $value;
                }
            }

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

            if (!empty($where)) {
                $sql .= ' WHERE ' . implode(' AND ', $where);
            }
            
            return $this->getByParams($params, $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function countAllCriteria(): int
    {
        try {
            $data = $this->getAll("SELECT COUNT(id) as 'total' FROM evaluation_criterias");

            return $data[0]['total'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function createCriteria(Criteria $criteria): void
    {
        try {
            $this->insert('evaluation_criterias', [
                'id' => $criteria->getId(),
                'standard_id' => $criteria->getStandardId(),
                'name' => $criteria->getName(),
                'department_id' => $criteria->getDepartmentId()
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function deleteCriteria(string $id): void
    {
        try {
            $this->delete("DELETE FROM evaluation_criterias WHERE id = ?", [$id]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function searchCriteria(string $search): array
    {
        // TODO:
        return [];
    }

    public function countSearchCriteria(string $search): int
    {
        // TODO:
        return 0;
    }
}
?>