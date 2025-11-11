<?php

namespace App\Database\Repositories\Implementations;

use App\Database\Repositories\Interfaces\DepartmentRepositoryInterface;
use Configs\Database;
use Core\Repository;
use PDOException;

class DepartmentRepository extends Repository implements DepartmentRepositoryInterface
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function getAllDepartment(): array
    {
        try {
            return $this->getAll("SELECT * FROM departments");
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }
}