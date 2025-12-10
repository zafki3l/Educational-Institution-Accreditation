<?php

namespace App\Repositories\Sql\Implementations;

use App\Repositories\Sql\Interfaces\DepartmentRepositoryInterface;
use Configs\Database\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;

class DepartmentRepository extends SqlRepository implements DepartmentRepositoryInterface
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