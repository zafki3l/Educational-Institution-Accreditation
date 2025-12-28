<?php

namespace App\Domain\Exceptions\FileUploadException;

use App\Domain\Exceptions\BusinessException;

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