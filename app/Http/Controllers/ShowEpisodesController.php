<?php

namespace SickRage\Http\Controllers;

use Illuminate\Database\Query\Builder as QueryBuilder;
use SickRage\Service\EpisodeStats;
use SickRage\tv_episode;
use SickRage\tv_show;

class ShowEpisodesController extends Controller
{

    /**
     * @var \SickRage\Service\EpisodeStats
     */
    private $stats;

    public function __construct(EpisodeStats $stats)
    {
        $this->stats = $stats;
    }

    public function index($show_id)
    {
        $query = tv_episode::where('showid',
            function (QueryBuilder $query) use ($show_id) {
                $query->from('tv_shows')
                    ->select('indexer_id')
                    ->where('show_id', '=', $show_id);
            });

        return response()->json($query->get());
    }

    public function stats($show_id)
    {
        return $this->stats->getStat($show_id);
    }

}
