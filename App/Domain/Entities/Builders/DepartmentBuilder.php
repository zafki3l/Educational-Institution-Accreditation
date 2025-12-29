<?php

namespace App\Domain\Entities\Builders;

use App\Domain\Entities\Models\Department;

class DepartmentBuilder
{
    private ?int $id;
    private ?string $name;

    public function setId(?int $id): self {$this->id = $id; return $this;}

	public function setName(?string $name): self {$this->name = $name; return $this;}

    public function build(): Department
    {
        return new Department(
            $this->id,
            $this->name
        );
    }
}