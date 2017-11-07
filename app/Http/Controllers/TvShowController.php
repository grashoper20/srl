<?php

namespace SRL\Http\Controllers;

use SRL\Service\EpisodeStats;
use SRL\tv_show;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TvShowController extends Controller
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
     * @return \SRL\tv_show[]
     */
    public function index()
    {
        return tv_show::with('imdb_info')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        throw new NotFoundHttpException();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        throw new MethodNotAllowedHttpException(['GET']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \SRL\tv_show $show
     * @return \SRL\tv_show
     */
    public function show(tv_show $show)
    {
        $show->load('imdb_info');

        return $show;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SRL\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function edit(tv_show $show)
    {
        throw new NotFoundHttpException();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SRL\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tv_show $show)
    {
        throw new MethodNotAllowedHttpException(['GET']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SRL\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(tv_show $show)
    {
        throw new MethodNotAllowedHttpException(['GET']);
    }

}
