<?php

namespace App\Services\Interfaces;

interface FileUploadServiceInterface
{
    /**
     * Keep old evidence if no new file is uploaded to avoid losing existing files.
     */
    public function evidenceUpload(?array $file, ?string $old_file = null): string;
}