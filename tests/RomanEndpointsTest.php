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
            $num = random_int(1,3999);
            factory(RomanNumeral::class)->create([
                'intNumber' => $num,
                'romanNumber' => $converter->toRomanNumerals($num),
                'hits' => random_int(1,10000)
            ]);
        }

        $records = DB::table('romanNumerals')->get();
        $this->assertEquals(11, count($records));

        $this->assertAttributeEquals(10, $this->json(
            'get', '/topten'
        ));
    }
}
