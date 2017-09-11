<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\RomanNumeral;

class RomanEndpointsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_lists_the_top_10_converted_integers()
    {
        $converter = new \App\IntegerConversion();

        for($i=0; $i<11; $i++) {

            factory(RomanNumeral::class)->create([
                'intNumber' => $i+1,
                'romanNumber' => $converter->toRomanNumerals($i+1),
                'hits' => random_int(1,10000)
            ]);
        }

        $records = \DB::table('roman_numerals')->get();
        $this->assertEquals(11, count($records));
        $expected = \DB::table('roman_numerals')
            ->orderBy('hits','desc')
                ->limit(10)
                ->get()
                ->toArray();


       $this->json('GET','api/topten')
           ->contains($expected);


    }

    /** @test */
    function it_lists_all_of_the_recently_converted_integers()
    {
        $converter = new \App\IntegerConversion();

        for($i=0; $i<100; $i++) {

            factory(RomanNumeral::class)->create([
                'intNumber' => $i+1,
                'romanNumber' => $converter->toRomanNumerals($i+1),
                'hits' => random_int(1,10000)
            ]);
        }
        $records = \DB::table('roman_numerals')->get();
        $this->assertEquals(100, count($records));

        $this->json('GET','api/index')
            ->seeStatusCode(200)
            ->contains($records);

    }



    /** @test */
    function it_accepts_an_integer_converts_it_to_a_roman_stores_it_in_db_and_returns_the_response()
    {
        $this->json('GET','api/convert/3')
            ->seeStatusCode(200)
            ->contains('III');

        $this->seeInDatabase('roman_numerals',[
           'intNumber' => 3,
            'romanNumber' => 'III',
            'hits' =>1
        ]);
        //$this->markTestIncomplete();
    }


    /** @test */
    function it_converts_below_3999()
    {
        $this->json('GET','api/convert/4000')
            ->seeStatusCode(422);

        $this->notSeeInDatabase('roman_numerals',[
            'intNumber' => 4000
        ]);
    }

    /** @test */
    function it_does_not_convert_strings()
    {
        $this->json('GET','api/convert/adas')
            ->seeStatusCode(422);

        $this->notSeeInDatabase('roman_numerals',[
            'intNumber' => 'adas'
        ]);
    }

}
