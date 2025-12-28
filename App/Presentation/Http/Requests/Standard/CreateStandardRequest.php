<?php

namespace App\Presentation\Http\Requests\Standard;

use App\Presentation\Http\Requests\Standard\StandardRequest;

class CreateStandardRequest extends StandardRequest
{
    private string $id;
    public function __construct(array $input)
    {
        $this->id = trim($input['id']);
        $this->name = trim($input['name']);
        $this->department_id = (int) trim($input['department_id']);
    }

    public function getId(): string {return $this->id;}
}