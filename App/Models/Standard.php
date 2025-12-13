<?php 

namespace App\Models;

use DateTime;

class Standard
{
    private string $id;
    private string $name;
	private int $department_id;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function getId(): string {return $this->id;}

	public function getName(): string {return $this->name;}

	public function getDepartmentId(): string {return $this->department_id;}

	public function getCreatedAt(): DateTime {return $this->created_at;}

	public function getUpdatedAt(): DateTime {return $this->updated_at;}

	public function setId(string $id): self {$this->id = $id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

	public function setDepartmentId(int $department_id): self {$this->department_id = $department_id; return $this;}

	public function setCreatedAt(DateTime $created_at): self {$this->created_at = $created_at; return $this;}

	public function setUpdatedAt(DateTime $updated_at): self {$this->updated_at = $updated_at; return $this;}
}