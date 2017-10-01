<?php

namespace SRL\Http\Controllers;

use SRL\imdb_info;
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
     * @param  \SRL\imdb_info $imdb
     * @return \Illuminate\Http\Response
     */
    public function show(imdb_info $imdb)
    {
        return response()->json($imdb);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SRL\imdb_info $imdb
     * @return \Illuminate\Http\Response
     */
    public function edit(imdb_info $imdb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SRL\imdb_info $imdb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, imdb_info $imdb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SRL\imdb_info $imdb
     * @return \Illuminate\Http\Response
     */
    public function destroy(imdb_info $imdb)
    {
        //
    }
}
