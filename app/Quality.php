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
    // TODO SD Combined?
    const COMBINED_SD = self::SDTV | self::SDDVD;
    const COMBINED_HD_720P = self::HDTV | self::HDWEBDL | self::HDBLURAY;
    const COMBINED_HD_1080P = self::FULLHDTV | self::FULLHDWEBDL | self::FULLHDBLURAY;
    const COMBINED_HD = self::COMBINED_HD_720P | self::COMBINED_HD_1080P;
    const COMBINED_UHD_4K = self::UHD_4K_TV | self::UHD_4K_WEBDL | self::UHD_4K_BLURAY;
    const COMBINED_UHD_8K = self::UHD_8K_TV | self::UHD_8K_WEBDL | self::UHD_8K_BLURAY;
    const COMBINED_UHD = self::COMBINED_UHD_4K | self::COMBINED_UHD_8K;
    const COMBINED_ANY = self::COMBINED_SD | self::COMBINED_HD | self::COMBINED_UHD;

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

    const QUALITY_STRINGS = [
        self::NONE              => 'N/A',
        self::SDTV              => 'SD TV',
        self::SDDVD             => 'SD DVD',
        self::HDTV              => '720p HDTV',
        self::RAWHDTV           => 'RawHD',
        self::FULLHDTV          => '1080p HDTV',
        self::HDWEBDL           => '720p WEB-DL',
        self::FULLHDWEBDL       => '1080p WEB-DL',
        self::HDBLURAY          => '720p BluRay',
        self::FULLHDBLURAY      => '1080p BluRay',
        self::UHD_4K_TV         => '4K UHD TV',
        self::UHD_8K_TV         => '8K UHD TV',
        self::UHD_4K_WEBDL      => '4K UHD WEB-DL',
        self::UHD_8K_WEBDL      => '8K UHD WEB-DL',
        self::UHD_4K_BLURAY     => '4K UHD BluRay',
        self::UHD_8K_BLURAY     => '8K UHD BluRay',
        self::UNKNOWN           => 'Unknown',
        // Combined.
        self::COMBINED_HD_720P  => "HD 720P",
        self::COMBINED_HD_1080P => "HD 1080P",
        self::COMBINED_UHD_4K   => "UHD 4k",
        self::COMBINED_UHD_8K   => "UHD 8k",
        self::COMBINED_SD       => "SD",
        self::COMBINED_HD       => "HD",
        self::COMBINED_UHD      => "UHD",
        self::COMBINED_ANY      => "Any",
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

    public static function getQualityText($quality)
    {
        $strings = [];
        foreach (array_reverse(self::QUALITY_STRINGS,
            true) as $bit_value => $string) {

            $match = false;
            if (!static::isPowerOfTwo($bit_value) && $quality == $bit_value) {
                $match = true;
            } elseif (($quality & $bit_value) === $bit_value) {
                $match = true;
            }

            if ($match) {
                $strings[$bit_value] = $string;
                $quality &= ~$bit_value;
            }
            // If there are no more qualities left, stop looping.
            if ($quality == 0) {
                break;
            }
        }

        ksort($strings);

        return $strings;
    }

    private static function isPowerOfTwo($num)
    {
        return ($num & ($num - 1)) === 0;
    }


}
