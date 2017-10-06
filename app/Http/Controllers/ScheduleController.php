<?php

namespace SRL\Http\Controllers;

use Grashoper\GregorianOrdinal\Date;
use SRL\Quality;
use SRL\Status;
use SRL\tv_episode;

class ScheduleController extends Controller
{

    public function get()
    {
        $snatched = array_merge(
            Quality::SNATCHED,
            Quality::SNATCHED_BEST,
            Quality::SNATCHED_PROPER);
        $status_list = array_merge([
            Status::WANTED,
            Status::UNAIRED,
        ], $snatched);
        sort($status_list);

        $missed_range = 7; // TODO Configurable?
        $recent = strtotime('-' . $missed_range . 'days midnight');

        return tv_episode::with('show')
            ->where('airdate', '>=', Date::ordinalFromTime($recent))
            ->whereIn('status', $status_list)
            ->orderBy('airdate', 'ASC')
            ->paginate();
    }

    function getNextAir($id)
    {
        $now = time();
        $t = tv_episode::select(['airdate',])
            ->where('showid', '=', $id)
            ->where('airdate', '>=', Date::ordinalFromTime($now))
            ->whereIn('status', [Status::UNAIRED, Status::WANTED])
            ->orderBy('airdate', 'asc')
            ->first();

        return $t ? $t->airdate : 0;
    }

}
