<?php

namespace App\Presentation\Http\Requests\Standard;

abstract class StandardRequest
{
    protected string $name;
	protected int $department_id;

    public function getName(): string {return $this->name;}

	public function getDepartmentId(): int {return $this->department_id;}	
}