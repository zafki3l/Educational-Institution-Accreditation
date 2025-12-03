<?php

namespace App\Exceptions\FileUploadException;

use App\Exceptions\BusinessException;

class NoFileException extends BusinessException
{
    public function __construct()
    {
        parent::__construct(
            "No file",
            'NO_FILE',
        );
    }
}