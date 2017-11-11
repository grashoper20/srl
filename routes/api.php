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

Route::resource('/show', 'TvShowController');
Route::resource('/imdb', 'ImdbInfoController');
Route::resource('/episode', 'TvEpisodeController');
Route::resource('/history', 'HistoryController');
Route::get('/show/{show}/episodes', 'TvEpisodeController@indexByShow'); // List episodes.
Route::get('/schedule', 'ScheduleController@get');
Route::get('/tools', 'ToolsController@get');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
