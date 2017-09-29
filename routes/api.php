<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/show', 'ShowController');
Route::get('/show/{show_id}/episodes', 'EpisodeController@indexByShow'); // List episodes.
Route::get('/show/{show_id}/stats', 'EpisodeController@statsByShow'); // Episode stats.
Route::get('/stats', 'EpisodeController@statsIndex');
Route::resource('/imdb', 'ImdbInfoController');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
