<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Configs\Database\Interfaces\Core\DatabaseInterface;
use Core\Repository;
use PDOException;

class DepartmentRepository extends Repository implements DepartmentRepositoryInterface
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