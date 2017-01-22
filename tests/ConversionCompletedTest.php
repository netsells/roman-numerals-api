<?php

namespace Tests;

use App\Conversion;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ConversionCompletedTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * PersistConversionToDatabase listener
     */
    public function testListenerSaveToStorage()
    {
        $conversions = factory(Conversion::class)->make();
        $arabic      = 4;

        $this->visit(route('romanToArabic', ['integer' => $arabic]));
        $row = $conversions::find(1);

        $this->assertEquals($arabic, $row->arabic);
        $this->assertEquals("IV", $row->roman);
    }

}
