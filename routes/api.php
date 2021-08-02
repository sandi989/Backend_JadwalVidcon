<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::get('jadwalVidcon', 'JadwalVidconController@index');
    Route::get('jadwalVidcon/{id}', 'JadwalVidconController@show');
    Route::get('jadwalVidconToday', 'JadwalVidconController@showJadwalToday');
    Route::post('jadwalVidcon', 'JadwalVidconController@store');
    Route::put('jadwalVidcon/{id}', 'JadwalVidconController@update');
    Route::delete('jadwalVidcon/{id}', 'JadwalVidconController@destroy');
