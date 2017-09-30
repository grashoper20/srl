<?php

namespace SickRage;

class Status
{
    const UNKNOWN         = -1;
    const UNAIRED         = 1;
    const SNATCHED        = 2;
    const WANTED          = 3;
    const DOWNLOADED      = 4;
    const SKIPPED         = 5;
    const ARCHIVED        = 6;
    const IGNORED         = 7;
    const SNATCHED_PROPER = 9;
    const SUBTITLED       = 10;
    const FAILED          = 11;
    const SNATCHED_BEST   = 12;

    function test() {
        mix();
    }
}