<?php

namespace Tests\Unit;

use SickRage\Quality;
use Tests\TestCase;

/**
 * Class QualityTest
 * @package Tests\Unit
 * @covers \SickRage\Quality
 */
class QualityTest extends TestCase
{

    /**
     * @dataProvider provideSplitQualities
     * @param $expected
     * @param $status
     */
    public function testQualitySpit($expected, $status) {
        $this->assertEquals($expected, Quality::splitCompositeStatus($status), "Status: $status");
    }


    public function provideSplitQualities() {
        return [
            [[1, 0], 1],
            [[3, 0], 3],
            [[5, 0], 5],
            [[7, 0], 7],
            [[4, 1], 104],
            [[4, 2], 204],
            [[4, 4], 404,],
            [[4, 16], 1604],
            [[4, 32], 3204,],
            [[4, 64], 6404],
            [[4, 128], 12804],
            [[4, 256], 25604],
            [[4, 32768], 3276804],
        ];
    }

}
