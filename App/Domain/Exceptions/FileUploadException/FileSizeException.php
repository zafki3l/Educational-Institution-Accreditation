<?php

namespace App\Domain\Exceptions\FileUploadException;

use App\Domain\Exceptions\BusinessException;

class FileSizeException extends BusinessException
{
    public function __construct()
    {
        parent::__construct(
            "File is too big",
            'SIZE_TOO_BIG',
        );
    }
}