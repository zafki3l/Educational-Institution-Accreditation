<?php

namespace App\Services\Implementations\Evidence\EvidenceUpload;

use App\Services\Implementations\FileUpload\FileUpload;

/**
 * Extends FileUpload for evidence-specific file handling.
 * Uploads to the 'evidences/' subdirectory.
 */
class EvidenceFileUpload extends FileUpload
{
    protected function getUploadPath(): string
    {
        return parent::BASE_UPLOAD_PATH . 'evidences/';
    }
}