<?php

namespace App\Repositories\Sql\Implementations;

use App\Repositories\Sql\Interfaces\RoleRepositoryInterface;
use Configs\Database\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;

class RoleRepository extends SqlRepository implements RoleRepositoryInterface
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