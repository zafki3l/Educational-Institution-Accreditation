<?php

namespace App\Exceptions\FileUploadException;

use App\Exceptions\BusinessException;

class NotAllowedFileException extends BusinessException
{
    public function __construct()
    {
        parent::__construct(
            "Not allowed file",
            'NOT_ALLOWED_FILE',
        );
    }
}