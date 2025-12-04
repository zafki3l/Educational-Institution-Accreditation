<?php

namespace App\Exceptions\FileUploadException;

use App\Exceptions\BusinessException;

class FileUploadException extends BusinessException
{
    public function __construct()
    {
        parent::__construct(
            "File upload failed due to unknown error",
            'UNKNOWN_EXCEPTION',
        );
    }
}