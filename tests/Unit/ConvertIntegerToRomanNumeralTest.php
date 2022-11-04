<?php

namespace Tests\Unit;

use App\Models\Conversion;
use PHPUnit\Framework\TestCase;
use App\Helpers\ConversionHelper;

class ConvertIntegerToRomanNumeralTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_convert_integer_to_roman_numerals(): void
    {
        $this->assertEquals('MMMCMXCIX', (new ConversionHelper)->convert(3999));
        $this->assertEquals('MMXVI', (new ConversionHelper)->convert(2016));
        $this->assertEquals('MMXVIII', (new ConversionHelper)->convert(2018));
    }

    /**
     * @test
     */
    public function it_should_store_the_converted_integers_to_database(): void
    {
        $randomInteger = 10;
        $converted = (new ConversionHelper)->convert($randomInteger);
        $response = Conversion::factory()->make([
            'numeral' => $randomInteger,
            'roman_numeral' => $converted
        ]);
        $this->assertEquals($response->roman_numeral, $converted);
        $this->assertEquals($response->number, $randomInteger);
    }

    /**
     * @test
     */
    public function it_should_list_all_recent_conversion(): void
    {
        $convert1 = Conversion::factory()->make([
            'number' => 1,
            'roman_numeral' => (new ConversionHelper)->convert(1)
        ]);
        $convert2 = Conversion::factory()->make([
            'number' => 2,
            'roman_numeral' => 'II'
        ]);
        $convert3 = Conversion::factory()->make([
            'number' => 3,
            'roman_numeral' => 'III'
        ]);

        $this->assertEquals($convert1->roman_numeral, 'I');
        $this->assertEquals($convert1->number, 1);
        $this->assertEquals($convert2->roman_numeral, 'II');
        $this->assertEquals($convert2->number, 2);
        $this->assertEquals($convert3->roman_numeral, 'III');
        $this->assertEquals($convert3->number, 3);
    }

    /**
     * @test
     */
    public function it_should_list_top_10_conversion(): void
    {
        $convert1 = Conversion::factory()->make([
            'number' => 1,
            'roman_numeral' => 'I'
        ]);
        $convert2 = Conversion::factory()->make([
            'number' => 1,
            'roman_numeral' => 'I'
        ]);
        $convert3 = Conversion::factory()->make([
            'number' => 10,
            'roman_numeral' => 'X'
        ]);
        $convert4 = Conversion::factory()->make([
            'number' => 4,
            'roman_numeral' => 'IV'
        ]);
        $convert5 = Conversion::factory()->make([
            'number' => 5,
            'roman_numeral' => 'V'
        ]);
        $convert6 = Conversion::factory()->make([
            'number' => 10,
            'roman_numeral' => 'X'
        ]);
        $convert7 = Conversion::factory()->make([
            'number' => 2,
            'roman_numeral' => 'II'
        ]);
        $convert8 = Conversion::factory()->make([
            'number' => 10,
            'roman_numeral' => 'X'
        ]);
        $convert9 = Conversion::factory()->make([
            'number' => 2,
            'roman_numeral' => 'II'
        ]);
        $convert10 = Conversion::factory()->make([
            'number' => 5,
            'roman_numeral' => 'V'
        ]);

        //integet 10 count 3
        $this->assertEquals($convert3->roman_numeral, 'X');
        $this->assertEquals($convert3->number, 10);
        $this->assertEquals($convert6->roman_numeral, 'X');
        $this->assertEquals($convert6->number, 10);
        $this->assertEquals($convert8->roman_numeral, 'X');
        $this->assertEquals($convert8->number, 10);

        //integet 1 count 2
        $this->assertEquals($convert1->roman_numeral, 'I');
        $this->assertEquals($convert1->number, 1);
        $this->assertEquals($convert2->roman_numeral, 'I');
        $this->assertEquals($convert2->number, 1);

        //integet 2 count 2
        $this->assertEquals($convert7->roman_numeral, 'II');
        $this->assertEquals($convert7->number, 2);
        $this->assertEquals($convert9->roman_numeral, 'II');
        $this->assertEquals($convert9->number, 2);

        //integet 5 count 2
        $this->assertEquals($convert5->roman_numeral, 'V');
        $this->assertEquals($convert5->number, 5);
        $this->assertEquals($convert10->roman_numeral, 'V');
        $this->assertEquals($convert10->number, 5);

        //integet 4 count 1
        $this->assertEquals($convert4->roman_numeral, 'IV');
        $this->assertEquals($convert4->number, 4);
    }
}
