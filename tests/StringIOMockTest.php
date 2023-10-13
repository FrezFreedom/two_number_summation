<?php declare(strict_types=1);

require_once ('StringIOMock.php');

use PHPUnit\Framework\TestCase;


class StringIOMockTest extends TestCase
{
    /**
     * @dataProvider provideInvalidReadIntInputData
     */
    public function testReadIntThrowsException($inputString)
    {
        $mock = new StringIOMock($inputString);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Input should be integer.');

        $mock->readInt();
    }

    public static function provideInvalidReadIntInputData(): array
    {
        return [
            ['abc'],
            ['45.16'],
            ['abc123'],
            [''],
            ['   '],
        ];
    }

    /**
     * @dataProvider providePrintListOutputsData
     */
    public function testPrintListOutputs($expectedOutput, $list)
    {
        $mock = new StringIOMock('');

        $mock->printList($list);

        $this->assertEquals($expectedOutput, $mock->getOutput());
    }

    public static function providePrintListOutputsData(): array
    {
        return [
            ["[]\n", []],
            ["[1]\n", [1]],
            ["[1, 2]\n", [1, 2]],
            ["[1, 2, 100]\n", [1, 2, 100]],
        ];
    }
}