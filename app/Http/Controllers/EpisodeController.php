<?php

namespace SickRage\Http\Controllers;

use Grashoper\GregorianOrdinal\Date;
use Illuminate\Database\Query\Builder as QueryBuilder;
use SickRage\Service\EpisodeStats;
use SickRage\tv_episode;

class EpisodeController
{
    /**
     * @var \SickRage\Service\EpisodeStats
     */
    private $stats;

    public function __construct(EpisodeStats $stats)
    {
        $this->stats = $stats;
    }

    public function indexByShow($show_id)
    {
        $query = tv_episode::where('showid',
            function (QueryBuilder $query) use ($show_id) {
                $query->from('tv_shows')
                    ->select('indexer_id')
                    ->where('show_id', '=', $show_id);
            });
        $episodes = $query->get();
        $episodes->each(function($episode) {
            /** @var tv_episode $episode */
            if ($episode->airdate > 1) {
                $episode->airdate = Date::dateFromOrdinal($episode->airdate)->format(DATE_RFC2822);
            }
        });

        return response()->json($episodes);
    }

    public function statsIndex()
    {
        return $this->stats->getAllStats();
    }

    public function statsByShow($show_id)
    {
        return response()->json($this->stats->getStat($show_id));
    }

}
