<?php

namespace App\Http\Controllers;

use App\IntegerConversion ;
use App\IntegerConversionException ;
use App\Http\Controllers\Controller;
use App\Http\Models\NumeralConversion as Database ;

class RomanConvertController extends Controller
{
    public function __invoke($integer)
    {
        try
        {
            $numeral = IntegerConversion::toRomanNumerals((int)$integer) ;

            Database::record($integer, $numeral) ;

            return json_encode(Array('integer' => $integer, 'numeral' => $numeral)) ;
        }
        catch (IntegerConversionException $e)
        {
            return json_encode(Array('error' => 'An error was encountered processing your request')) ;
        }
    }
}
