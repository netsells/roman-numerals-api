<?php

namespace App\Services;

class RomanNumeralConverter implements IntegerConverterInterface
{
    /**
     * Lookup list of integers to numerals
     *
     * @var array NUMERAL_LOOKUP
     */
    private const NUMERAL_LOOKUP = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I',
    ];

    /**
     * Convert base 10 to Roman Numeral
     *
     * @param int $integer
     *
     * @return string
     */
    public function convertInteger(int $integer): string
    {
        // Early return if we match without having to calculate
        if (array_key_exists($integer, static::NUMERAL_LOOKUP)) {
            return static::NUMERAL_LOOKUP[$integer];
        }
        $numeralString = '';

        foreach (static::NUMERAL_LOOKUP as $number => $numeral) {
            if ($number <= $integer) {
                $numeralString .= str_repeat($numeral, $integer/$number);
                $integer = $integer % $number;
            }
        }

        return $numeralString;
    }
}
