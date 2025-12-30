<?php

namespace App\Business\FileUpload;

interface EvidenceFileUploadInterface
{
    public function upload(?array $file, ?string $old_file = null): string;
}