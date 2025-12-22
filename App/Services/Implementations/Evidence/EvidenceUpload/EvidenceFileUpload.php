<?php

namespace App\Services\Implementations\Evidence\FileUpload;

use App\Services\Implementations\FileUpload;

class EvidenceFileUpload extends FileUpload
{
    protected function getUploadPath(): string
    {
        return parent::BASE_UPLOAD_PATH . 'evidences/';
    }
}