<?php

namespace SickRage\Http\Controllers;

use SickRage\tv_show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(tv_show::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function show(tv_show $show) {
        return response()->json($show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function edit(tv_show $show) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tv_show $show) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SickRage\tv_show $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(tv_show $show) {
        //
    }
}
