<?php

namespace App\Domain\Exceptions\FileUploadException;

use App\Domain\Exceptions\BusinessException;

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