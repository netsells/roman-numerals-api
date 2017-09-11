<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RomanNumeralTest extends TestCase
{

    public function testIntegerToRomanNumerals()
    {
        $class = new \App\IntegerConversion();

        // Test the basic conversions
        $toTest = [
            'I' => 1,
            'II' => 2,
            'III' => 3,
            'IV' => 4,
            'V' => 5,
            'VI' => 6,
            'IX' => 9,
            'X' => 10,
            'XI' => 11,
            'XX' => 20,
            'L' => 50,
            'C' => 100,
            'XL' => 40,

            'XC' => 90,
            'CD' => 400,
            'D' => 500,
            'CM' => 900,
            'M' => 1000,
        ];

        foreach ($toTest as $returnValue => $integer) {
            $this->assertEquals($returnValue, $class->toRomanNumerals($integer));
        }

        // Test more unique integers
        $this->assertEquals('MMMCMXCIX', $class->toRomanNumerals(3999));
        $this->assertEquals('MMXVI', $class->toRomanNumerals(2016));
    }

    function test_it_returns_false_if_the_number_is_bigger_than_3999(){
        $class = new \App\IntegerConversion();

        $this->assertFalse($class->toRomanNumerals(4000));
        $this->assertFalse($class->toRomanNumerals(9500));
    }
}
