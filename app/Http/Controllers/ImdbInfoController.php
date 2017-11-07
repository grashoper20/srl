<?php

namespace SRL\Http\Controllers;

use SRL\imdb_info;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImdbInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \SRL\imdb_info[]
     */
    public function index()
    {
        return imdb_info::all();
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
     * @param  \SRL\imdb_info $imdb
     * @return \SRL\imdb_info
     */
    public function show(imdb_info $imdb)
    {
        return $imdb;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SRL\imdb_info $imdb
     * @return \Illuminate\Http\Response
     */
    public function edit(imdb_info $imdb)
    {
        throw new NotFoundHttpException();
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
        throw new MethodNotAllowedHttpException(['GET']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SRL\imdb_info $imdb
     * @return \Illuminate\Http\Response
     */
    public function destroy(imdb_info $imdb)
    {
        throw new MethodNotAllowedHttpException(['GET']);
    }
}
