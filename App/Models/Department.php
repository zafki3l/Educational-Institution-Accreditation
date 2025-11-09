<?php

namespace App\Models;

use Configs\Database;
use Core\Model;
use PDOException;

class Department extends Model
{
    private int $id;
    private string $name;

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

    public function getId(): int {return $this->id;}

	public function getName(): string {return $this->name;}

    public function setId(int $id): void {$this->id = $id;}

	public function setName(string $name): void {$this->name = $name;}
}