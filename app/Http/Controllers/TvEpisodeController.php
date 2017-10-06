<?php

namespace SRL\Http\Controllers;

use Grashoper\GregorianOrdinal\Date;
use SRL\Service\EpisodeStats;
use SRL\tv_episode;
use Illuminate\Http\Request;
use SRL\tv_show;

class TvEpisodeController extends Controller
{

    /**
     * @var \SRL\Service\EpisodeStats
     */
    private $stats;

    public function __construct(EpisodeStats $stats)
    {
        $this->stats = $stats;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \SRL\tv_episode[]
     */
    public function index()
    {
        return tv_episode::all();
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
     * @param  \SRL\tv_episode $episode
     * @return \SRL\tv_episode
     */
    public function show(tv_episode $episode)
    {
        return $episode;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SRL\tv_episode $episode
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
     * @param  \SRL\tv_episode $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tv_episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SRL\tv_episode $tv_episodes
     * @return \Illuminate\Http\Response
     */
    public function destroy(tv_episode $tv_episodes)
    {
        //
    }

    public function indexByShow(tv_show $show)
    {
        return $show->episodes()->get();
    }

}
