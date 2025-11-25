<?php

namespace App\Exceptions\DepartmentException;

use App\Exceptions\BusinessException;

class DepartmentNotFoundException extends BusinessException
{
    public function __construct(string $department_id)
    {
        parent::__construct(
            "Department with id $department_id not found", 
            'DEPARTMENT_NOT_FOUND',
            '404'
        );

        $this->setMeta(['department_id' => $department_id]);
    }
}