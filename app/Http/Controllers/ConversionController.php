<?php

namespace App\Http\Controllers;

use App\Contracts\ConversionStorage;
use App\Events\ConversionCompleted;
use App\Exceptions\InputRangeExceeded;
use App\Exceptions\InvalidInputNumber;
use App\IntegerConversion;
use App\Transformers\RomanTransformer;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class ConversionController extends Controller
{
    /**
     * @param $integer
     */
    public function run($integer)
    {
        try {
            $roman = (new IntegerConversion)->toRomanNumerals($integer);

            //trigger the event
            event(new ConversionCompleted($integer, $roman));

            //output result
            return fractal(
                $roman,
                new RomanTransformer
            )->respond();

        } catch (InputRangeExceeded $e) {

            return $this->error('input_range_exceeded',
                403,
                ['range' => env('range', '1-3999')]
            );
        } catch (InvalidInputNumber $e) {

            return $this->error('invalid_input_number',
                403,
                ['range' => env('range', '1-3999')]
            );
        }
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->error('invalid_endpoint',
            403,
            ['romanToArabic' => route('romanToArabic', ['integer' => 1])]
        );
    }
}
