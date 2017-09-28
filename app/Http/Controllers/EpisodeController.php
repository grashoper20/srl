<?php

namespace SickRage\Http\Controllers;

use SickRage\Service\EpisodeStats;

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

    public function stats()
    {
        return $this->stats->getAllStats();
    }

}