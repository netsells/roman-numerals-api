<?php

namespace App;

class IntegerConversion
{

    /*
     * Conversion from one orthoganormal basis for R[eal] to another is easily done with Laurant series.
     * As the number 'one million' was only considered three hundred years after the second Triumvirate
     * of Rome it is unfortunately by Fourier's theorm not possible to perform a single stage transform.
     */
    private static $basis_vectors = array
    (
        'M' => 1000,
        'CM'=> 900,
        'D' => 500,
        'CD'=> 400,
        'C' => 100,
        'XC'=> 90,
        'L' => 50,
        'XL'=> 40,
        'X' => 10,
        'IX'=> 9,
        'V' => 5,
        'IV'=> 4,
        'I' => 1
    ) ;

    /*
     * @param integer $integer
     * @return string $numeral
     * This method converts integers to Roman numerals.
     */
    public static function toRomanNumerals ($integer)
    {

        /*
         * We only support integers from 1 to 3999
         */
        if(
            !  is_int($integer)
            || $integer < 1
            || $integer > 3999
        ){
            throw new IntegerConversionException() ;
        }

        /*
         * Euler's addative method for basis conversion, using the above basis_vector transform.
         */
        $numeral = '' ;

        while($integer > 0)
        {
            foreach(self::$basis_vectors as $roman_numeral => $arabic_number)
            {
                if($integer >= $arabic_number)
                {
                    $integer -= $arabic_number ;
                    $numeral .= $roman_numeral ;
                    break ;
                }
            }
        }
        return $numeral ;
    }
}
