<?php 

namespace App\Database\Repositories\Implementations;

use App\Database\Repositories\Interfaces\CriteriaRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;
use Core\Repository;
use PDOException;

class CriteriaRepository extends Repository implements CriteriaRepositoryInterface
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function getAllCriteria(int $start_from, int $result_per_page): array
    {
        try{
            $sql = "SELECT ec.id as 'criteria_id',
                            es.id as 'standard_id',
                            ec.name as 'criteria_name',
                            department_id,
                            ec.created_at,
                            ec.updated_at
                    FROM evaluation_criterias ec
                    JOIN evaluation_standards es
                        ON ec.standard_id = es.id
                    JOIN departments ON ec.department_id = departments.id
                    LIMIT $start_from, $result_per_page";
            
            return $this->getAll($sql);
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

    public function searchCriteria(string $search, int $start_from, int $result_per_page): array
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