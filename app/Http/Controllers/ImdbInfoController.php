<?php

namespace SickRage\Http\Controllers;

use SickRage\imdb_info;
use Illuminate\Http\Request;

class ImdbInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(imdb_info::all());
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
     * @param  \SickRage\imdb_info $imdb_info
     * @return \Illuminate\Http\Response
     */
    public function show(imdb_info $imdb_info, $indexer_id)
    {
        // TODO fix binding to use correct id.
        $imdb_info = imdb_info::find($indexer_id);
        return response()->json($imdb_info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SickRage\imdb_info $imdb_info
     * @return \Illuminate\Http\Response
     */
    public function edit(imdb_info $imdb_info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SickRage\imdb_info $imdb_info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, imdb_info $imdb_info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SickRage\imdb_info $imdb_info
     * @return \Illuminate\Http\Response
     */
    public function destroy(imdb_info $imdb_info)
    {
        //
    }
}
