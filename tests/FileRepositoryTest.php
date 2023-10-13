<?php declare(strict_types=1);

namespace Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Repository\FileRepository;
use Repository\FileServiceInterface;

class FileRepositoryTest extends TestCase
{
    /**
     * @dataProvider provideLoadNumericListExceptionsData
     */
    public function testLoadNumericListExceptions($expectExceptionMessage, $mockOfFileService)
    {
        $repository = new FileRepository('fakeAddress', $mockOfFileService);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage($expectExceptionMessage);

        $repository->loadNumericList();
    }

    private static function createMockOfFileServiceInterface(bool $fileExistsReturn, bool | string $fileGetContentsReturn): FileServiceInterface
    {
        $mockOfFileService = \Mockery::mock(FileServiceInterface::class);
        $mockOfFileService->shouldReceive('fileExists')->andReturn($fileExistsReturn);
        $mockOfFileService->shouldReceive('fileGetContents')->andReturn($fileGetContentsReturn);

        return $mockOfFileService;
    }

    public static function provideLoadNumericListExceptionsData()
    {
        yield [
            'File not found.',
            FileRepositoryTest::createMockOfFileServiceInterface(false, false),
        ];

        yield [
            'Unable to read file content.',
            FileRepositoryTest::createMockOfFileServiceInterface(true, false),
        ];

        yield [
            'Failed to decode json.',
            FileRepositoryTest::createMockOfFileServiceInterface(true, "[123"),
        ];

        yield [
            'Content should be a list.',
            FileRepositoryTest::createMockOfFileServiceInterface(true, "{\"fake\": 123}"),
        ];

        yield [
            'Content should be a list of integers.',
            FileRepositoryTest::createMockOfFileServiceInterface(true, "[1, 2, \"100\"]"),
        ];
    }


    /**
     * @dataProvider provideLoadNumericListData
     */
    public function testLoadNumericList($expectOutput, $mockOfFileService)
    {
        $repository = new FileRepository('fakeAddress', $mockOfFileService);

        $output = $repository->loadNumericList();

        $this->assertEquals($expectOutput, $output);
    }

    public static function provideLoadNumericListData()
    {
        yield [
            [],
            FileRepositoryTest::createMockOfFileServiceInterface(true, "[]"),
        ];

        yield [
            [1],
            FileRepositoryTest::createMockOfFileServiceInterface(true, "[1]"),
        ];

        yield [
            [100, 50, 20, 1],
            FileRepositoryTest::createMockOfFileServiceInterface(true, "[100, 50, 20, 1]"),
        ];
    }
}