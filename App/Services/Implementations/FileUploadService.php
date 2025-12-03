<?php

namespace App\Services\Implementations;

use App\Exceptions\FileUploadException\FileSizeException;
use App\Exceptions\FileUploadException\NoFileException;
use App\Exceptions\FileUploadException\NotAllowedFileException;
use App\Services\Interfaces\FileUploadServiceInterface;
use App\Validations\Interfaces\FileUploadValidatorInterface;

class FileUploadService implements FileUploadServiceInterface
{
    private const ALLOWED_SIZE = 20_000_000;
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];

    public function __construct(private FileUploadValidatorInterface $fileUploadValidator) {}

    public function evidenceUpload(): string
    {
        return $this->fileUpload(__DIR__ . '/../../../public/images/evidences/');
    }

    private function fileUpload(string $uploadDirection): string
    {
        $validator = $this->fileUploadValidator;

        if (!$validator->isUpload()) {
            throw new NoFileException();
        }

        if ($validator->isUploadFailed()) {
            exit('There is something wrong');
        }

        $file_name = $_FILES['file']['name'];

        $file_separator = explode('.', $file_name);
        $file_extension = strtolower(end($file_separator));

        if (!$validator->isAllowedFile($file_extension, self::ALLOWED_EXTENSIONS)) {
            throw new NotAllowedFileException();
        }

        if ($validator->isFileTooLarge($_FILES['file']['size'], self::ALLOWED_SIZE)) {
            throw new FileSizeException();
        }

        $newFileName = uniqid('', true) . '.' . $file_extension;

        $fileDestination = $uploadDirection . $newFileName;

        if (!is_dir($uploadDirection) && !mkdir($uploadDirection, 0775, true) && !is_dir($uploadDirection)) {
            throw new \RuntimeException("Failed to create upload directory: {$uploadDirection}");
        }


        if (!move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)) {
            throw new \RuntimeException('Failed to move uploaded file.');
        }

        return $newFileName;
    }
}