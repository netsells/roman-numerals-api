<?php

namespace Tests;

use App\Exceptions\InputRangeExceeded;
use App\Exceptions\InvalidInputNumber;
use App\IntegerConversion;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RomanNumeralTest extends TestCase
{
    public function setUp()
    {
        $this->integerConversion = app(IntegerConversion::class);
        parent::setUp();
    }

    public function testIntergerToRomanNumerals()
    {
        // Test the basic conversions
        $toTest = [
            'I'  => 1,
            'IV' => 4,
            'V'  => 5,
            'IX' => 9,
            'X'  => 10,
            'C'  => 100,
            'XL' => 40,
            'L'  => 50,
            'XC' => 90,
            'CD' => 400,
            'D'  => 500,
            'CM' => 900,
            'M'  => 1000
        ];

        foreach ($toTest as $returnValue => $integer) {
            $this->assertEquals($returnValue, $this->integerConversion->toRomanNumerals($integer));
        }

        // Test more unique integers
        $this->assertEquals('MMMCMXCIX', $this->integerConversion->toRomanNumerals(3999));
        $this->assertEquals('MMXVI', $this->integerConversion->toRomanNumerals(2016));
    }

    public function testInputRangeExceeded()
    {
        $this->expectException(InputRangeExceeded::class);
        $this->integerConversion->toRomanNumerals(4444);
        $this->integerConversion->toRomanNumerals(-1);
    }

    public function testInvalidInputNumber()
    {
        $this->expectException(InvalidInputNumber::class);
        $this->integerConversion->toRomanNumerals(0);
    }
}
