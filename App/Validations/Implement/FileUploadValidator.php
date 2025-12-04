<?php

namespace App\Validations\Implement;

use App\Validations\Interfaces\FileUploadValidatorInterface;
use Core\Validator;

class FileUploadValidator extends Validator implements FileUploadValidatorInterface
{
    public function isUpload(): bool
    {
        return isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE;
    }

    /**
     * Ensure only process successfully uploaded files
     */
    public function isUploadFailed(): bool
    {
        return $_FILES['file']['error'] !== UPLOAD_ERR_OK;
    }

    /**
     * Only allowed file can be upload, avoiding malicious file
     */
    public function isAllowedFile(string $file_extension, array $allowed_extension): bool
    {
        return \in_array($file_extension, $allowed_extension);
    }

    /**
     * Prevent server overload from huge uploads
     */
    public function isFileTooLarge(int $size, int $allowed_size): bool
    {
        return $size > $allowed_size;
    }
}