<?php

/*
 * We only accept integers comprising the digits 0-9
 */
Route::get('convert/{integer}/roman', 'RomanConvertController')->where(['integer' => '[0-9]+']) ;
/*
 * Returns the top N most successful conversions.
 */
Route::get('top/{count}', 'TopConvertedController')->where(['count' => '[0-9]+']) ;
/*
 * Returns the N most recent successful conversions.
 */
Route::get('last/{count}', 'MostRecentController')->where(['count' => '[0-9]+']) ;
