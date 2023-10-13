<?php


interface FileServiceInterface
{
    public function fileExists(string $filePath): bool;
    public function fileGetContents(string $filePath): bool | string;
}