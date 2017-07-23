<?php

/*
 * We only accept integers conprising the digits 0-9
 */
Route::get('convert/{integer}/roman', 'RomanConvertController')->where(['integer' => '[0-9]+']) ;
