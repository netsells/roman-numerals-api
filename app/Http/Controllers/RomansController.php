<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RomanNumeral;
use App\IntegerConversion;



class RomansController extends Controller
{
    protected $converter;


    public function __construct(
        IntegerConversion $converter

    )
    {
        $this->converter = $converter;

    }

    public function topten()
    {
        //get topten

        $romans = RomanNumeral::orderBy('hits', 'desc')->limit(10)->get();

        return fractal()
            ->collection($romans)
            ->transformWith(function($roman){
                return [
                  'number' => $roman->intNumber,
                  'roman' => $roman->romanNumber,
                  'hits' => $roman->hits
                ];
            })
            ->toArray();

    }

    public function index()
    {
        $romans = RomanNumeral::orderBy('intNumber')->get();

        return fractal()
            ->collection($romans)
            ->transformWith(function($roman){
                return [
                    'number' => $roman->intNumber,
                    'roman' => $roman->romanNumber,
                    'hits' => $roman->hits
                ];
            })
            ->toArray();
    }

    public function convert($intNumber)
    {

        //1. convert
        $converted = $this->converter->toRomanNumerals($intNumber);
        if($converted==false) return response()->json(
            ['error'=>'Invalid Number']
            ,422);
        //2. findOrCreate in the db
        $roman = RomanNumeral::firstOrNew([
            'intNumber' => $intNumber,
            'romanNumber' => $converted,
        ]);
        //3. add one to hit
        $roman->hits +=1;
        $roman->save();

        return fractal()
            ->item($roman)
            ->transformWith(function($roman){
                return [
                    'number' => $roman->intNumber,
                    'roman' => $roman->romanNumber
                ];
            })
            ->toArray();
    }
}
