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

Route::Resource('/weather', 'App\Http\Controllers\WeatherController');
Route::get('/media/generate-photo', 'App\Http\Controllers\MediaController@generatePhoto');
Route::get('/media/compress-image', 'App\Http\Controllers\MediaController@compressImage');
Route::get('/media/test-compression', 'App\Http\Controllers\MediaController@testCompression');
Route::Resource('/media', 'App\Http\Controllers\MediaController');
