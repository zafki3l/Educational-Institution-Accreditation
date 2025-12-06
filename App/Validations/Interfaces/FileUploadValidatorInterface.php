<?php

namespace App\Validations\Interfaces;

interface FileUploadValidatorInterface
{
    public function isUpload(array $file): bool;
    public function isUploadFailed(array $file): bool;
    public function isAllowedFile(string $file_extension, array $allowed_extension): bool;
    public function isFileTooLarge(int $size, int $allowed_size): bool;
}