<?php declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\TwoNumberSummation;

class TwoNumberSummationTest extends TestCase
{
    /**
     * @dataProvider provideTwoNumberSummationData
     */
    public function testTwoNumberSummation(bool $expectedAnswer, int $x, $list)
    {
        $twoNumberSummation = new TwoNumberSummation();

        $answer = $twoNumberSummation->solve($x, $list);

        $this->assertEquals($expectedAnswer, $answer);
    }

    public static function provideTwoNumberSummationData()
    {
        yield [
            true,
            5,
            [1, 6, 4],
        ];

        yield [
            true,
            10,
            [1, 6, 4],
        ];

        yield [
            false,
            6,
            [1, 6, 4],
        ];

        yield [
            false,
            5,
            [5],
        ];

        yield [
            false,
            5,
            [5, 5, 5],
        ];

        yield [
            false,
            0,
            [0],
        ];

        yield [
            false,
            0,
            [],
        ];
    }
}