<?php 

namespace App\Repositories\Implementations;

use App\Models\Standard;
use App\Repositories\Interfaces\StandardRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;
use Core\Repository;
use PDOException;

class StandardRepository extends Repository implements StandardRepositoryInterface
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function getAllStandard(): array
    {
        try {
            return $this->getAll("SELECT * FROM evaluation_standards");
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function createStandard(Standard $standard): void
    {
        try {
            $this->insert('evaluation_standards', [
                'id' => $standard->getId(),
                'name' => $standard->getName()
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function deleteStandard(string $id): void
    {
        try {
            $this->delete("DELETE FROM evaluation_standards WHERE id = ?", [$id]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}