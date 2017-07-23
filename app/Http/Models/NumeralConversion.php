<?php

namespace App\Http\Models ;

use Illuminate\Database\Eloquent\Model ;

class NumeralConversion extends Model
{
    public $timestamps = false ;

    /*
     * The table that holds the history of numeral conversions.
     */
    protected $table = 'roman_numerals_converted' ;
    protected $fillable = ['integer', 'numeral'] ;
    
    /*
     * NumeralConversion is an Eloquent-singleton under the hood.
     * Here we save a row in the table by creating a new row instance.
     */
    protected static function record ($integer, $numeral)
    {
        $numeralConversion = new NumeralConversion() ;
        $numeralConversion->integer = $integer ;
        $numeralConversion->numeral = $numeral ;
        $numeralConversion->save() ;
    }

}
