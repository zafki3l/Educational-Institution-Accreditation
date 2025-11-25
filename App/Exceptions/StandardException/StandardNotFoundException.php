<?php

namespace App\Exceptions\StandardException;

use App\Exceptions\BusinessException;

class StandardNotFoundException extends BusinessException
{
    public function __construct(string $standard_id)
    {
        parent::__construct(
            "Standard with id $standard_id not found", 
            'STANDARD_NOT_FOUND',
            '404'
        );

        $this->setMeta(['standard_id' => $standard_id]);
    }
}