<?php

namespace App\Http\Models ;

use DB ;
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
    public static function record ($integer, $numeral)
    {
        $numeralConversion = new NumeralConversion() ;
        $numeralConversion->integer = $integer ;
        $numeralConversion->numeral = $numeral ;
        $numeralConversion->save() ;
    }

    /*
     * Here we get the top N entries.
     */
    public static function top ($count)
    {
        return NumeralConversion::select([
                'integer',
                'numeral', 
                DB::raw('COUNT(`id`) AS frequency')
            ])
            ->groupBy('integer')
            ->orderByRaw('frequency DESC')
            ->limit((int)$count)
            ->get() ;
    }

    /*
     * Here we get the last N entries.
     */
    public static function last ($count)
    {
        return NumeralConversion::select(['integer', 'numeral'])
            ->orderByRaw('id DESC')
            ->limit((int)$count)
            ->get() ;
    }
}
