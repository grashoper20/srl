<?php

namespace SRL\Http\Controllers;

use SRL\history;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\SRL\history[]
     */
    public function index(Request $request)
    {
        $q = history::query();
        $q->with('show');
        return history::buildVueTablesResult($q, $request);
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
     * @param  \SRL\history $history
     * @return \Illuminate\Http\Response
     */
    public function show(history $history)
    {
        throw new NotFoundHttpException();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SRL\history $history
     * @return \Illuminate\Http\Response
     */
    public function edit(history $history)
    {
        throw new NotFoundHttpException();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SRL\history $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, history $history)
    {
        throw new MethodNotAllowedHttpException(['GET']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SRL\history $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(history $history)
    {
        throw new MethodNotAllowedHttpException(['GET']);
    }
}
