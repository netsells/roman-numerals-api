<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\ConversionHelper;
use App\Services\RomanNumeralConverter;

class RomanNumeralTest extends TestCase
{
    private RomanNumeralConverter $converter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new RomanNumeralConverter();
    }

    public function testConvertsIntegersToRomanNumerals(): void
    {
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
            $this->assertEquals($returnValue, (new ConversionHelper)->convert($integer));
        }

        // Test more unique integers
        $this->assertEquals('MMMCMXCIX', (new ConversionHelper)->convert(3999));
        $this->assertEquals('MMXVI', (new ConversionHelper)->convert(2016));
        $this->assertEquals('MMXVIII', (new ConversionHelper)->convert(2018));
    }
}
