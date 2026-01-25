<?php

namespace App\Infrastructure\Persistent\Repositories\Sql;

use App\Business\Ports\DepartmentRepositoryInterface;
use App\Infrastructure\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;

class MySqlDepartmentRepository extends SqlRepository implements DepartmentRepositoryInterface
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