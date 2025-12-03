<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\FileUploadServiceInterface;

class FileUploadService implements FileUploadServiceInterface
{
    public function fileUpload(): string
    {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
            return 'No file';
        }

        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            exit('There is something wrong');
        }

        $file_name = $_FILES['file']['name'];

        $file_separator = explode('.', $file_name);
        $file_extension = strtolower(end($file_separator));

        if (!in_array($file_extension, static::allowedFile())) {
            exit('Not Allowed file!');
        }

        if ($_FILES['file']['size'] >= 20_000_000) {
            exit('File too big (Limit: 20 MB)');
        }

        $uploadDirection = __DIR__ . '/../../../public/images/evidences/';
        $newFileName = uniqid('', true) . '.' . $file_extension;

        $fileDestination = $uploadDirection . $newFileName;

        if (!is_dir($uploadDirection)) {
            mkdir($uploadDirection, 0775, true);
        }

        move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination);

        return $newFileName;
    }

    public static function allowedFile(): array
    {
        return ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'docx'];
    }
}