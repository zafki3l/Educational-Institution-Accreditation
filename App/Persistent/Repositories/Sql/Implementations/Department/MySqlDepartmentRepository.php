<?php

namespace App\Persistent\Repositories\Sql\Implementations\Department;

use App\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;

class MySqlDepartmentRepository extends SqlRepository
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function all(): array
    {
        try {
            return $this->getAll("SELECT * FROM departments");
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }
}