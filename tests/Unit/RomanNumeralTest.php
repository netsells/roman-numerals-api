<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RomanNumeralTest extends TestCase
{
    public function testIntergerToRomanNumerals()
    {
        $class = new \App\IntegerConversion();

        // Test the basic conversions
        $toTest = [
            'I' => 1,
            'IV' => 4,
            'V' => 5,
            'IX' => 9,
            'X' => 10,
            'C' => 100,
            'XL' => 40,
            'L' => 50,
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
        $this->assertEquals('MMXVIII', $class->toRomanNumerals(2018));
    }
}
