<?php

namespace App\Database\Models;

class Department
{
    private int $id;
    private string $name;

    public function getId(): int {return $this->id;}

	public function getName(): string {return $this->name;}

    public function setId(int $id): self {$this->id = $id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}
}