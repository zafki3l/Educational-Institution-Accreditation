<?php

namespace App\Services\Implementations;

use App\Exceptions\FileUploadException\FileSizeException;
use App\Exceptions\FileUploadException\FileUploadException;
use App\Exceptions\FileUploadException\NoFileException;
use App\Exceptions\FileUploadException\NotAllowedFileException;
use App\Services\Interfaces\FileUploadServiceInterface;
use App\Validations\Interfaces\FileUploadValidatorInterface;

class FileUploadService implements FileUploadServiceInterface
{
    private const ALLOWED_SIZE = 20_000_000;
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];
    private const BASE_UPLOAD_PATH = __DIR__ . '/../../../public/assets/';
    private const ENVIDENCE_UPLOAD_PATH = self::BASE_UPLOAD_PATH . 'evidences/';

    public function __construct(private FileUploadValidatorInterface $fileUploadValidator) {}

    /**
     * Keep old evidence if no new file is uploaded to avoid losing existing files.
     */
    public function evidenceUpload(?array $file, ?string $old_file = null): string
    {
        return $this->upload(self::ENVIDENCE_UPLOAD_PATH, $file, $old_file);
    }

    /**
     * Central place to handle uploads safely and reuse logic.
     * Keeps old file if none is provided.
     */
    private function upload(string $upload_path, array $file, ?string $old_file): string
    {
        if ($this->keepOldFileIfNoNewUpload($file, $old_file)) {
            return $old_file;
        }

        $this->validateUpload($file, $this->fileUploadValidator);

        $file_extension = $this->getFileExtension($file['name']);

        $this->validateFile($this->fileUploadValidator, $file_extension, $file['size']);

        $new_file_name = $this->generateFileName($file_extension);

        $file_destination = $upload_path . $new_file_name;

        $this->ensureDirectory($upload_path);

        $this->moveUploadedFile($file['tmp_name'], $file_destination);

        return $new_file_name;
    }

    /**
     * Keep old file if no new file is uploaded to avoid losing existing files.
     */
    private function keepOldFileIfNoNewUpload(array $file, string $old_file): bool
    {
        return $old_file !== null && !$this->fileUploadValidator->isUpload($file);
    }

    /**
     * Ensure there is a valid file to process before continuing.
     */
    private function validateUpload(array $file, FileUploadValidatorInterface $validator): void
    {
        if (!$validator->isUpload($file)) {
            throw new NoFileException();
        }

        if ($validator->isUploadFailed($file)) {
            throw new FileUploadException();
        }
    }

    /**
     * Extract file extension for naming and validation purposes.
     */
    private function getFileExtension(string $file_name): string
    {
        $file_separator = explode('.', $file_name);

        return strtolower(end($file_separator));
    }

    /**
     * Keep file rules in one place to make changes easy and consistent.
     */
    private function validateFile(FileUploadValidatorInterface $validator, string $file_extension, int $size): void
    {
        if (!$validator->isAllowedFile($file_extension, self::ALLOWED_EXTENSIONS)) {
            throw new NotAllowedFileException();
        }

        if ($validator->isFileTooLarge($size, self::ALLOWED_SIZE)) {
            throw new FileSizeException();
        }
    }

    /**
     * Ensure uploaded files have unique names to avoid overwriting.
     */
    private function generateFileName(string $file_extension): string
    {
        return uniqid('', true) . '.' . $file_extension;
    }

    /**
     * Create directory if it doesn’t exist to prevent upload failures.
     */
    private function ensureDirectory(string $upload_path): void
    {
        if (!is_dir($upload_path) && !mkdir($upload_path, 0775, true)) {
            throw new \RuntimeException("Cannot create directory: $upload_path");
        }
    }

    /**
     * Move the uploaded file to its destination securely.
     */
    private function moveUploadedFile(string $tmp_name, string $file_destination): void
    {
        if (!move_uploaded_file($tmp_name, $file_destination)) {
            throw new \RuntimeException('Failed to move uploaded file.');
        }
    }
}