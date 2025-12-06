<?php

namespace App\Validations\Interfaces;

interface FileUploadValidatorInterface
{
    public function isUpload(array $file): bool;

    /**
     * Ensure only process successfully uploaded files
     */
    public function isUploadFailed(array $file): bool;
    
    /**
     * Only allowed file can be upload, avoiding malicious file
     */
    public function isAllowedFile(string $file_extension, array $allowed_extension): bool;

    /**
     * Prevent server overload from huge uploads
     */
    public function isFileTooLarge(int $size, int $allowed_size): bool;
}