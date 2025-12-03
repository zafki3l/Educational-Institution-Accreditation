<?php

namespace App\Validations\Interfaces;

interface FileUploadValidatorInterface
{
    public function isUpload(): bool;
    public function isUploadFailed(): bool;
    public function isAllowedFile(string $file_extension, array $allowed_extension): bool;
    public function isFileTooLarge(int $size, int $allowed_size): bool;
}