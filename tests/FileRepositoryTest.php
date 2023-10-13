<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once (__DIR__ . '/../FileRepository.php');
require_once (__DIR__ . '/../FileServiceInterface.php');

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
        $mockOfFileService = \Mockery::mock('FileServiceInterface');
        $mockOfFileService->shouldReceive('fileExists')->andReturn($fileExistsReturn);
        $mockOfFileService->shouldReceive('fileGetContents')->andReturn($fileGetContentsReturn);

        return $mockOfFileService;
    }

    public static function provideLoadNumericListExceptionsData(): Generator
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

    public static function provideLoadNumericListData(): Generator
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