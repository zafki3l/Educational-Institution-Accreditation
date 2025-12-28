<?php

namespace App\Domain\Exceptions\FileUploadException;

use App\Domain\Exceptions\BusinessException;

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