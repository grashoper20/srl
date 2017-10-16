<?php

namespace Tests\Unit;

use SRL\Quality;
use PHPUnit\Framework\TestCase;

class QualityTest extends TestCase
{

    /**
     * @covers ::getQualityText
     * @dataProvider qualityTextCombinations
     */
    public function testQualityText($bit_value, $expected)
    {
        $this->assertEquals($expected, Quality::getQualityText($bit_value));
    }

    public function qualityTextCombinations()
    {
        $makeResult = function ($const) {
            return [$const => Quality::QUALITY_STRINGS[$const]];
        };

        return [
            [
                Quality::SDTV | Quality::HDTV,
                [
                    Quality::SDTV => Quality::QUALITY_STRINGS[Quality::SDTV],
                    Quality::HDTV => Quality::QUALITY_STRINGS[Quality::HDTV],
                ],
            ],
            [
                Quality::SDTV,
                $makeResult(Quality::SDTV),
            ],
            [
                Quality::SDDVD,
                $makeResult(Quality::SDDVD),
            ],
            [
                Quality::HDTV,
                $makeResult(Quality::HDTV),
            ],
            [
                Quality::HDWEBDL,
                $makeResult(Quality::HDWEBDL),
            ],
            [
                Quality::HDBLURAY,
                $makeResult(Quality::HDBLURAY),
            ],
            [
                Quality::RAWHDTV,
                $makeResult(Quality::RAWHDTV),
            ],
            [
                Quality::FULLHDTV,
                $makeResult(Quality::FULLHDTV),
            ],
            [
                Quality::FULLHDWEBDL,
                $makeResult(Quality::FULLHDWEBDL),
            ],
            [
                Quality::FULLHDBLURAY,
                $makeResult(Quality::FULLHDBLURAY),
            ],
            [
                Quality::COMBINED_UHD_4K,
                $makeResult(Quality::COMBINED_UHD_4K),
            ],
            [
                Quality::COMBINED_UHD_8K,
                $makeResult(Quality::COMBINED_UHD_8K),
            ],
            [
                Quality::COMBINED_SD,
                $makeResult(Quality::COMBINED_SD),
            ],
            [
                Quality::COMBINED_HD,
                $makeResult(Quality::COMBINED_HD),
            ],
            [
                Quality::COMBINED_UHD,
                $makeResult(Quality::COMBINED_UHD),
            ],
            [
                Quality::COMBINED_ANY,
                $makeResult(Quality::COMBINED_ANY),
            ],
        ];
    }
}
