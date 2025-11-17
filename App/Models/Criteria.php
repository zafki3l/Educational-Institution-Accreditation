<?php

namespace App\Models;

use DateTime;

class Criteria
{
    private string $id;
    private string $standard_id;
    private string $name;
	private int $department_id;
    private Datetime $created_at;
    private DateTime $updated_at;

    public function getId(): string {return $this->id;}

	public function getStandardId(): string {return $this->standard_id;}

	public function getName(): string {return $this->name;}

	public function getDepartmentId(): int {return $this->department_id;}

	public function getCreatedAt(): Datetime {return $this->created_at;}

	public function getUpdatedAt(): DateTime {return $this->updated_at;}

	public function setId(string $id): self {$this->id = $id; return $this;}

	public function setStandardId(string $standard_id): self {$this->standard_id = $standard_id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

	public function setDepartmentId(int $department_id): self {$this->department_id = $department_id; return $this;}

	public function setCreatedAt(Datetime $created_at): self {$this->created_at = $created_at; return $this;}

	public function setUpdatedAt(DateTime $updated_at): self {$this->updated_at = $updated_at; return $this;}
}