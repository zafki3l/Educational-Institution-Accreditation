<?php

namespace App\Entities\Builders;

use App\Entities\Models\Standard;

class StandardBuilder
{
    private string $id;
    private string $name;
    private int $department_id;

    public function setId(string $id): self {$this->id = $id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

	public function setDepartmentId(int $department_id): self {$this->department_id = $department_id; return $this;}

    public function build(): Standard
    {
        return new Standard(
            $this->id,
            $this->name,
            $this->department_id
        );
    }
}