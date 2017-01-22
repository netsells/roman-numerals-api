<?php

namespace App;

use App\Exceptions\InputRangeExceeded;
use App\Exceptions\InvalidInputNumber;

class IntegerConversion implements IntegerConversionInterface
{

    /**
     * @var Illuminate\Support\Collection
     */
    protected $collection;

    public function __construct()
    {
        $this->collection = collect([
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        ]);
    }

    /**
     * @param $integer
     */
    public function toRomanNumerals($integer = null): string
    {
        //checks for empty input (including zero)
        if (empty($input = intval($integer))) {
            throw new InvalidInputNumber;
        }

        //supports integer ranging from 1 to 3999
        if ($input < env('MIN', 1) || $input > env('MAX', 3999)) {
            throw new InputRangeExceeded;
        }

        $output = '';
        while ($input > 0) {
            $this->subtract($input, $output);
        }

        return $output;
    }

    /**
     * subtracts input, creates output
     * @param $input
     * @param $output
     */
    public function subtract(int &$input, string &$output)
    {
        $this->collection->each(
            function ($arabic, $roman) use (&$input, &$output) {
                if ($input >= $arabic) {
                    $input -= $arabic;
                    $output .= $roman;
                    return false;
                }
            });
    }
}
