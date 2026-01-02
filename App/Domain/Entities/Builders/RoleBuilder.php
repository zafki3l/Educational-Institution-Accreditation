<?php

namespace App\Domain\Entities\Builders;

use App\Domain\Entities\Models\Role;

class RoleBuilder
{
    private ?int $id;
    private ?string $name;

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function build(): Role
    {
        return new Role(
            $this->id,
            $this->name
        );
    }
}
