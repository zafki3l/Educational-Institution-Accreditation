<?php 

namespace App\Domain\Entities\Models;

class Standard
{
	public function __construct(private string $id,
								private string $name,
								private int $department_id) {}

    public function getId(): string {return $this->id;}

	public function getName(): string {return $this->name;}

	public function getDepartmentId(): string {return $this->department_id;}
}