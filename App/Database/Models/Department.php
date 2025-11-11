<?php

namespace App\Database\Models;

class Department
{
    public const DEPARTMENT_FINANCIAL = 1;

    private int $id;
    private string $name;

    public static function ensureDepartmentIsFinancial(int $department_id)
    {
        return $department_id === self::DEPARTMENT_FINANCIAL;
    }

    public function getId(): int {return $this->id;}

	public function getName(): string {return $this->name;}

    public function setId(int $id): self {$this->id = $id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}
}