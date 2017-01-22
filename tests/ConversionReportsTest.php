<?php

namespace Tests;

use App\Conversion;
use App\IntegerConversion;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ConversionReportsTest extends TestCase
{
    use DatabaseMigrations;

    public function testRecently()
    {
        $conversions = factory(Conversion::class)->make();

        $this->visit(route('romanToArabic', ['integer' => 1]));
        $this->visit(route('romanToArabic', ['integer' => 2]));
        $this->visit(route('romanToArabic', ['integer' => 3]));

        $this->visit(route('recent'));
        $this->assertResponseOk();
    }

    public function testTop10()
    {
        $conversions = factory(Conversion::class)->make();

        $this->visit(route('romanToArabic', ['integer' => 1]));
        $this->visit(route('romanToArabic', ['integer' => 2]));
        $this->visit(route('romanToArabic', ['integer' => 3]));

        $this->visit(route('top10'));
        $this->assertResponseOk();
    }
}
