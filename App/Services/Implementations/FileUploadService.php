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

    public function evidenceUpload(?string $old_file = null): string
    {
        return $this->upload(self::ENVIDENCE_UPLOAD_PATH, $old_file);
    }

    private function upload(string $uploadDirection, ?string $old_file): string
    {
        $validator = $this->fileUploadValidator;
        
        if ($old_file !== null && !isset($_FILES['file'])) {
            return $old_file;
        }

        $this->validateUpload($validator);

        $file_extension = $this->getFileExtension();

        $this->validateFile($validator, $file_extension, $_FILES['file']['size']);

        $newFileName = $this->generateFileName($file_extension);

        $file_destination = $uploadDirection . $newFileName;

        $this->ensureDirectory($uploadDirection);

        $this->moveUploadedFile($file_destination);

        return $newFileName;
    }

    private function validateUpload(FileUploadValidatorInterface $validator): void
    {
        if (!$validator->isUpload()) {
            throw new NoFileException();
        }

        if ($validator->isUploadFailed()) {
            throw new FileUploadException();
        }
    }

    private function getFileExtension(): string
    {
        $file_name = $_FILES['file']['name'];
        $file_separator = explode('.', $file_name);

        return strtolower(end($file_separator));
    }

    private function validateFile(FileUploadValidatorInterface $validator, string $file_extension, int $size): void
    {
        if (!$validator->isAllowedFile($file_extension, self::ALLOWED_EXTENSIONS)) {
            throw new NotAllowedFileException();
        }

        if ($validator->isFileTooLarge($size, self::ALLOWED_SIZE)) {
            throw new FileSizeException();
        }
    }

    private function generateFileName(string $file_extension): string
    {
        return uniqid('', true) . '.' . $file_extension;
    }

    private function ensureDirectory(string $uploadDirection): void
    {
        if (!is_dir($uploadDirection) && !mkdir($uploadDirection, 0775, true)) {
            throw new \RuntimeException("Cannot create directory: $uploadDirection");
        }
    }

    private function moveUploadedFile(string $file_destination): void
    {
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $file_destination)) {
            throw new \RuntimeException('Failed to move uploaded file.');
        }
    }
}