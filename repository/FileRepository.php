<?php

require_once ('RepositoryInterface.php');
require_once ('FileServiceInterface.php');

class FileRepository implements RepositoryInterface
{
    public function __construct(private string $filePath,
                                private FileServiceInterface $fileService)
    {
    }

    /**
     * @throws Exception
     */
    public function loadNumericList(): array
    {
        $this->checkFileExistence();

        $decodedContent = $this->read();

        $this->validateNumericList($decodedContent);

        return $decodedContent;
    }

    /**
     * @throws Exception
     */
    private function checkFileExistence(): void
    {
        if(!$this->fileService->fileExists($this->filePath))
        {
            throw new Exception('File not found.');
        }
    }

    /**
     * @throws Exception
     */
    private function read()
    {
        $fileContent = $this->fileService->fileGetContents($this->filePath);
        if($fileContent === false)
        {
            throw new Exception('Unable to read file content.');
        }

        $decodedContent = json_decode($fileContent);
        if($decodedContent === null)
        {
            throw new Exception('Failed to decode json.');
        }

        return $decodedContent;
    }

    /**
     * @throws Exception
     */
    private function validateNumericList($decoded): void
    {
        if (!is_array($decoded)) {
            throw new Exception('Content should be a list.');
        }

        foreach ($decoded as $item) {
            if (!is_int($item)) {
                throw new Exception('Content should be a list of integers.');
            }
        }
    }
}