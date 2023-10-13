<?php

namespace Repository;

class FileService implements FileServiceInterface
{
    public function fileExists(string $filePath): bool
    {
        return file_exists($filePath);
    }

    public function fileGetContents(string $filePath): bool | string
    {
        return file_get_contents($filePath);
    }
}