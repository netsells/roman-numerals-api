<?php

namespace Tests\Feature;

use App\Models\Numeral;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RomanNumeralConverterTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_convert_a_number_to_numeral()
    {
        $convertedNumber = 1234;
        $expectedNumeral = 'MCCXXXIV';

        $response = $this->create_numeral($convertedNumber);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'number' => $convertedNumber,
                'numeral' => $expectedNumeral
            ]);
    }

    public function test_it_saves_the_converted_number()
    {
        $convertedNumber = 2342;
        $expectedNumeral = 'MMCCCXLII';

        $response = $this->create_numeral($convertedNumber);

        $records = Numeral::all();

        $response->assertStatus(201);
        $this->assertCount(1, $records);
        $this->assertEquals($convertedNumber, $records->first()->number);
        $this->assertEquals($expectedNumeral, $records->first()->numeral);
    
    }

    public function test_it_creates_a_conversion_record_as_well_as_numeral_record()
    {
        $convertedNumber = 1994;
        $response = $this->create_numeral($convertedNumber);

        $record = Numeral::all()->first();

        $response->assertStatus(201);
        $this->assertCount(1, $record->conversions);
    }

    public function test_it_updates_the_updated_at_field_when_existing_numeral()
    {
        $convertedNumber = 1776;
        $response = $this->create_numeral($convertedNumber);

        $record = Numeral::all()->first();
        $record->updated_at = now()->addMinutes(-10);
        $record->save();

        $response = $this->json('POST', '/api/v1/numerals', [
            'number' => $convertedNumber
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'last_converted_at' => now()->toDateTimeString(),
                'conversion_count' => 2
            ]);
    }

    public function test_it_returns_validation_error_when_outside_bounds()
    {
        $response = $this->create_numeral(0);
        $response->assertStatus(422);

        $response = $this->create_numeral(9999);
        $response->assertStatus(422);
    }

    public function test_it_returns_validation_error_when_not_integer()
    {
        $response = $this->create_numeral("IAmNotANumberIAmAFreeMan");

        $response->assertStatus(422);
    }

    public function test_it_returns_validation_error_when_no_content()
    {
        $response = $this->create_numeral("");

        $response->assertStatus(422);
    }

    public function test_it_returns_recent_conversions()
    {
        $numbers = [
            3456 => "MMMCDLVI",
            1066 => "MLXVI",
            3111 => "MMMCXI",
        ];
        // TODO: Potentially replace with a factory
        foreach ($numbers as $number => $numeral) {
            $this->create_numeral($number);
        }

        $response = $this->json('GET', '/api/v1/numerals');
        $response->assertStatus(200);
        $this->assertCount(3, $response->getData()->data);

        foreach ($numbers as $number => $numeral) {
            $response->assertJsonFragment([
                'number' => $number,
                'numeral' => $numeral
            ]);
        }
    }

    public function test_it_returns_top_conversions()
    {
        $numbers = [
            1987,
            2345,
            3521,
        ];
        // TODO: Potentially replace with a factory
        foreach ($numbers as $index => $number) {
            for ($i=$index+1; $i<=3; $i++) {
                $this->create_numeral($number);
            }
        }

        $response = $this->json('GET', '/api/v1/numerals/top');
        $response->assertStatus(200);
        $data = $response->getData();

        // Check the order and the counts for each conversions
        // TODO: Loop it
        $this->assertEquals($numbers[0], $data->data[0]->number);
        $this->assertEquals(3, $data->data[0]->conversion_count);

        $this->assertEquals($numbers[1], $data->data[1]->number);
        $this->assertEquals(2, $data->data[1]->conversion_count);

        $this->assertEquals($numbers[2], $data->data[2]->number);
        $this->assertEquals(1, $data->data[2]->conversion_count);

    }

    private function create_numeral($number): TestResponse
    {
        return $this->json('POST', '/api/v1/numerals', [
            'number' => $number
        ]);
    }

}