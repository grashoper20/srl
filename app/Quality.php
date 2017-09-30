<?php

namespace SickRage;

class Quality
{
    const NONE = 0;
    const SDTV = 1; // 1
    const SDDVD = 1 << 1; // 2
    const HDTV = 1 << 2; // 4
    const RAWHDTV = 1 << 3; // 8
    const FULLHDTV = 1 << 4; // 16
    const HDWEBDL = 1 << 5; // 32
    const FULLHDWEBDL = 1 << 6; // 64
    const HDBLURAY = 1 << 7; // 128
    const FULLHDBLURAY = 1 << 8; // 256
    const UHD_4K_TV = 1 << 9; // 512
    const UHD_4K_WEBDL = 1 << 10; // 1024
    const UHD_4K_BLURAY = 1 << 11; // 2048
    const UHD_8K_TV = 1 << 12; // 4096
    const UHD_8K_WEBDL = 1 << 13; // 8192
    const UHD_8K_BLURAY = 1 << 14; // 16384
    const UNKNOWN = 1 << 15;  // 32768

    // Common combined formats.
    const ANYHDTV = self::HDTV | self::FULLHDTV;
    const ANYWEBDL = self::HDWEBDL | self::FULLHDWEBDL;
    const ANYBLURAY = self::HDBLURAY | self::FULLHDBLURAY;

    const HD720p = self::HDTV | self::HDWEBDL | self::HDBLURAY;
    const HD1080p = self::FULLHDTV | self::FULLHDWEBDL | self::FULLHDBLURAY;
    const UHD_4K = self::UHD_4K_TV | self::UHD_4K_WEBDL | self::UHD_4K_BLURAY;
    const UHD_8K = self::UHD_8K_TV | self::UHD_8K_WEBDL | self::UHD_8K_BLURAY;

    const SD = self::SDTV | self::SDDVD;
    const HD = self::HD720p | self::HD1080p;
    const UHD = self::UHD_4K | self::UHD_8K;
    const ANY = self::SD | self::HD | self::UHD;

    // Masks used for splitting combined bit fields.
    const ALLOWED_MASK = (1 << 16) - 1;
    const PREFERRED_MASK = self::ALLOWED_MASK << 16;

    const qualityString = [
        self::NONE => 'N/A',
        self::UNKNOWN => 'Unknown',
        self::SDTV => 'SDTV',
        self::SDDVD => 'SD DVD',
        self::HDTV => '720p HDTV',
        self::RAWHDTV => 'RawHD',
        self::FULLHDTV => '1080p HDTV',
        self::HDWEBDL => '720p WEB-DL',
        self::FULLHDWEBDL => '1080p WEB-DL',
        self::HDBLURAY => '720p BluRay',
        self::FULLHDBLURAY => '1080p BluRay',
        self::UHD_4K_TV => '4K UHD TV',
        self::UHD_8K_TV => '8K UHD TV',
        self::UHD_4K_WEBDL => '4K UHD WEB-DL',
        self::UHD_8K_WEBDL => '8K UHD WEB-DL',
        self::UHD_4K_BLURAY => '4K UHD BluRay',
        self::UHD_8K_BLURAY => '8K UHD BluRay',
    ];

    const combinedQualityStrings = [
        self::ANYHDTV => "HDTV",
        self::ANYWEBDL => "WEB-DL",
        self::ANYBLURAY => "BluRay"
    ];

    /**
     * Split a quality bit field into its individual qualities.
     *
     * @param $quality
     * @return array
     */
    public static function split($quality)
    {
        $preferred = ($quality & static::PREFERRED_MASK) >> 16;
        $allowed = ($quality & static::ALLOWED_MASK);
        $allowed_list = $preferred_list = [];
        for ($i = 0; $i < 16; ++$i) {
            // Pull off one bit and multiply it by its value tracked in $i.
            $allowed_list[] = pow(2, $i) * ($allowed & 1);
            $preferred_list[] = pow(2, $i) * ($preferred & 1);
            // Shift off the bits we just computed.
            $allowed >>= 1;
            $preferred >>= 1;
        }

        return [
            'preferred' => array_values(array_filter($preferred_list)),
            'allowed'   => array_values(array_filter($allowed_list)),
        ];
    }

}
