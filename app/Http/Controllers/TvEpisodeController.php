<?php

namespace SickRage\Http\Controllers;

use Grashoper\GregorianOrdinal\Date;
use SickRage\Service\EpisodeStats;
use SickRage\tv_episode;
use Illuminate\Http\Request;
use SickRage\tv_show;

class TvEpisodeController extends Controller
{

    /**
     * @var \SickRage\Service\EpisodeStats
     */
    private $stats;

    public function __construct(EpisodeStats $stats)
    {
        $this->stats = $stats;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = tv_episode::all();
        $episodes->each(function ($episode) {
            $this->processEpisode($episode);
        });

        return response()->json($episodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SickRage\tv_episode $episode
     * @return \Illuminate\Http\Response
     */
    public function show(tv_episode $episode)
    {
        return response()->json($episode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SickRage\tv_episode $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(tv_episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SickRage\tv_episode $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tv_episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SickRage\tv_episode $tv_episodes
     * @return \Illuminate\Http\Response
     */
    public function destroy(tv_episode $tv_episodes)
    {
        //
    }

    public function indexByShow(tv_show $show)
    {
        // Show ID is the show indexer id not the show id and indexer_id is the
        // episode indexer id. Confusing but its the way things are.
        return response()->json(
            tv_episode::whereShowid($show->indexer_id)->get()
        );
    }

    public function statsIndex()
    {
        return response()->json(array_values($this->stats->getAllStats()));
    }

    public function statsByShow(tv_show $show)
    {
        return response()->json($this->stats->getStat($show->indexer_id));
    }

}
