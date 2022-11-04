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

Route::group(['prefix' => '/convert'], function ($router) {
    $router->post('', [
        'as' => 'convert.store', 'uses' => 'ConversionController@store'
    ]);
    $router->get('/top', [
        'as' => 'convert.top', 'uses' => 'ConversionController@top'
    ]);
    $router->get('/recent', [
        'as' => 'convert.index', 'uses' => 'ConversionController@index'
    ]);
});