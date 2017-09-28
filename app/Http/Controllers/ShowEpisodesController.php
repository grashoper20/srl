<?php

namespace SickRage\Http\Controllers;

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

    protected function getEpisodeShowId($show_id)
    {
        // Show Id is really indexer id. indexer id is not... its weird.
        return tv_show::findOrFail($show_id)->indexer_id;
    }

    public function index($show_id)
    {
        $query = tv_episode::where('showid', '=',
            $this->getEpisodeShowId($show_id));

        return response()->json($query->get());
    }

    public function stats($show_id)
    {
        return $this->stats->getStat($this->getEpisodeShowId($show_id));
    }

}
