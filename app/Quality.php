<?php


namespace SRL;

class Quality
{
    const NONE = 0;                // 0
    const SDTV = 1;                // 1
    const SDDVD = 1 << 1;          // 2
    const HDTV = 1 << 2;           // 4
    const RAWHDTV = 1 << 3;        // 8
    const FULLHDTV = 1 << 4;       // 16
    const HDWEBDL = 1 << 5;        // 32
    const FULLHDWEBDL = 1 << 6;    // 64
    const HDBLURAY = 1 << 7;       // 128
    const FULLHDBLURAY = 1 << 8;   // 256
    const UHD_4K_TV = 1 << 9;      // 512
    const UHD_4K_WEBDL = 1 << 10;  // 1024
    const UHD_4K_BLURAY = 1 << 11; // 2048
    const UHD_8K_TV = 1 << 12;     // 4096
    const UHD_8K_WEBDL = 1 << 13;  // 8192
    const UHD_8K_BLURAY = 1 << 14; // 16384
    const UNKNOWN = 1 << 15;       // 32768

    // Combined.
    const ANYHDTV = self::HDTV | self::FULLHDTV;           // 20
    const ANYWEBDL = self::HDWEBDL | self::FULLHDWEBDL;    // 96
    const ANYBLURAY = self::HDBLURAY | self::FULLHDBLURAY; // 384

    const SNATCHED = [
        Status::SNATCHED + 100 * Quality::SDTV,
        Status::SNATCHED + 100 * Quality::SDDVD,
        Status::SNATCHED + 100 * Quality::HDTV,
        Status::SNATCHED + 100 * Quality::RAWHDTV,
        Status::SNATCHED + 100 * Quality::FULLHDTV,
        Status::SNATCHED + 100 * Quality::HDWEBDL,
        Status::SNATCHED + 100 * Quality::FULLHDWEBDL,
        Status::SNATCHED + 100 * Quality::HDBLURAY,
        Status::SNATCHED + 100 * Quality::FULLHDBLURAY,
        Status::SNATCHED + 100 * Quality::UHD_4K_TV,
        Status::SNATCHED + 100 * Quality::UHD_4K_WEBDL,
        Status::SNATCHED + 100 * Quality::UHD_4K_BLURAY,
        Status::SNATCHED + 100 * Quality::UHD_8K_TV,
        Status::SNATCHED + 100 * Quality::UHD_8K_WEBDL,
        Status::SNATCHED + 100 * Quality::UHD_8K_BLURAY,
        Status::SNATCHED + 100 * Quality::UNKNOWN,
    ];
    const SNATCHED_BEST = [
        Status::SNATCHED_BEST + 100 * Quality::SDTV,
        Status::SNATCHED_BEST + 100 * Quality::SDDVD,
        Status::SNATCHED_BEST + 100 * Quality::HDTV,
        Status::SNATCHED_BEST + 100 * Quality::RAWHDTV,
        Status::SNATCHED_BEST + 100 * Quality::FULLHDTV,
        Status::SNATCHED_BEST + 100 * Quality::HDWEBDL,
        Status::SNATCHED_BEST + 100 * Quality::FULLHDWEBDL,
        Status::SNATCHED_BEST + 100 * Quality::HDBLURAY,
        Status::SNATCHED_BEST + 100 * Quality::FULLHDBLURAY,
        Status::SNATCHED_BEST + 100 * Quality::UHD_4K_TV,
        Status::SNATCHED_BEST + 100 * Quality::UHD_4K_WEBDL,
        Status::SNATCHED_BEST + 100 * Quality::UHD_4K_BLURAY,
        Status::SNATCHED_BEST + 100 * Quality::UHD_8K_TV,
        Status::SNATCHED_BEST + 100 * Quality::UHD_8K_WEBDL,
        Status::SNATCHED_BEST + 100 * Quality::UHD_8K_BLURAY,
        Status::SNATCHED_BEST + 100 * Quality::UNKNOWN,
    ];
    const SNATCHED_PROPER = [
        Status::SNATCHED_PROPER + 100 * Quality::SDTV,
        Status::SNATCHED_PROPER + 100 * Quality::SDDVD,
        Status::SNATCHED_PROPER + 100 * Quality::HDTV,
        Status::SNATCHED_PROPER + 100 * Quality::RAWHDTV,
        Status::SNATCHED_PROPER + 100 * Quality::FULLHDTV,
        Status::SNATCHED_PROPER + 100 * Quality::HDWEBDL,
        Status::SNATCHED_PROPER + 100 * Quality::FULLHDWEBDL,
        Status::SNATCHED_PROPER + 100 * Quality::HDBLURAY,
        Status::SNATCHED_PROPER + 100 * Quality::FULLHDBLURAY,
        Status::SNATCHED_PROPER + 100 * Quality::UHD_4K_TV,
        Status::SNATCHED_PROPER + 100 * Quality::UHD_4K_WEBDL,
        Status::SNATCHED_PROPER + 100 * Quality::UHD_4K_BLURAY,
        Status::SNATCHED_PROPER + 100 * Quality::UHD_8K_TV,
        Status::SNATCHED_PROPER + 100 * Quality::UHD_8K_WEBDL,
        Status::SNATCHED_PROPER + 100 * Quality::UHD_8K_BLURAY,
        Status::SNATCHED_PROPER + 100 * Quality::UNKNOWN,
    ];

    /**
     * Split combined status/quality field into usable values.
     *
     * @param $status
     * @return array
     *   [status, quality]
     */
    public static function splitCompositeStatus($status)
    {
        return [$status % 100, intdiv($status, 100)];
    }

    /**
     * Combine status/quality field into compressed value.
     *
     * @param int $status
     * @param int $quality
     * @return int
     */
    public static function combineCompositeStatus($status, $quality)
    {
        return $status + (100 * $quality);
    }

//Quality.SNATCHED = [Quality.compositeStatus(SNATCHED, x) for x in Quality.qualityStrings if x is not None]
//Quality.SNATCHED_BEST = [Quality.compositeStatus(SNATCHED_BEST, x) for x in Quality.qualityStrings if x is not None]
//Quality.SNATCHED_PROPER = [Quality.compositeStatus(SNATCHED_PROPER, x) for x in Quality.qualityStrings if x is not None]
}
