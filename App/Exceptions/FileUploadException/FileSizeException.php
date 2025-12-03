<?php

namespace App\Exceptions\FileUploadException;

use App\Exceptions\BusinessException;

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