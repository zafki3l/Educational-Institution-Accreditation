<?php

namespace App\Http\Requests\Standard;

abstract class StandardRequest
{
    protected readonly string $name;
	protected readonly int $department_id;

    public function getName(): string {return $this->name;}

	public function getDepartmentId(): int {return $this->department_id;}	
}