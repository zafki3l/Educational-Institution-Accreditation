<?php

namespace App\Database\Repositories;

use App\Database\Models\Department;
use Configs\Database;
use Core\Repository;
use PDOException;

class DepartmentRepository extends Repository
{
    public function __construct(Database $db,
                                private Department $department)
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