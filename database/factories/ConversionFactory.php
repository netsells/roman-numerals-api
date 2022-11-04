<?php

namespace Database\Factories;

use App\Models\Conversion;
use App\Helpers\ConversionHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conversion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => 10,
            'roman_numeral' => (new ConversionHelper)->convert(10),
        ];
    }
}
