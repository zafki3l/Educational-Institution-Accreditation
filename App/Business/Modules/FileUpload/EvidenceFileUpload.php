<?php

namespace App\Business\Modules\FileUpload;

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

    public function upload(?array $file, ?string $old_file = null): string
    {
        return parent::upload($file, $old_file);
    }
}