<?php

namespace App;

class IntegerConversion implements IntegerConversionInterface
{
    protected static $lookup = [
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
        1 => 'I'
    ];

    public function toRomanNumerals($number)
    {
        if($number > 3999) return false;

        $result = '' ;
        foreach(static::$lookup as $num => $latin) {
            while($number >= $num ){
                $result .= $latin;
                $number -= $num;
            }
        }
        return $result;
    }
}