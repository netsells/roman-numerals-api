<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\RomanNumeral;


$factory->define(RomanNumeral::class, function (Faker\Generator $faker) {
    $converter = new \App\IntegerConversion();
    $num = random_int(1,3999);
    return [
        'intNumber' => $num,
        'romanNumber' => $converter->toRomanNumerals($num),
        'hits' => random_int(1,10000)
    ];
});
