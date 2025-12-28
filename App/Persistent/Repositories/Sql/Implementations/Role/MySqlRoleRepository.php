<?php

namespace App\Persistent\Repositories\Sql\Implementations\Role;

use App\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;

class MySqlRoleRepository extends SqlRepository
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function all(): array
    {
        try {
            return $this->getAll("SELECT * from roles");
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }
}