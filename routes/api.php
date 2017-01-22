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

Route::group(['prefix' => 'v1', 'middleware' => 'throttle:120'], function () {
    Route::get('/number', 'ConversionController@index');

    //limit the input to four digits
    Route::get('/number/{integer}', 'ConversionController@run')
        ->where('integer', '^-?\d{1,4}$')
        ->name('romanToArabic');

    Route::get('/reports/top10', 'ReportsController@top10')->name('top10');
    Route::get('/reports/recent', 'ReportsController@recent')->name('recent');
});
