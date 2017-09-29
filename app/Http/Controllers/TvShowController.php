<?php

namespace SickRage\Http\Controllers;

use Grashoper\GregorianOrdinal\Date;
use SickRage\Service\EpisodeStats;
use SickRage\tv_show;
use Illuminate\Http\Request;

class TvShowController extends Controller
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
        $shows = tv_show::all();
        foreach ($shows as $show) {
            $this->process($show);
        }

        return response()->json($shows);
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
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function show(tv_show $show)
    {
        $this->process($show);

        return response()->json($show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function edit(tv_show $show)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tv_show $show)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(tv_show $show)
    {
        //
    }

    /**
     * @param tv_show $show
     */
    protected function process($show)
    {
        $stats = $this->stats->getStat($show->show_id);
        if ($stats->total == 0) { // div by 0 is bad.
            $show->progress = 0;
        }
        else {
            $show->progress = $stats->downloaded / $stats->total;
        }
        if ($show->air_by_date) {
            $show->air_by_date = Date::timeFromOrdinal($show->air_by_date);
        }
    }

}
