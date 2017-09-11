<?php

use Illuminate\Database\Seeder;

class RomansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $converter = new \App\IntegerConversion();
        for($i=1; $i<150; $i++)
        {
            factory(\App\Models\RomanNumeral::class)->create([
                'intNumber' => $i,
                'romanNumber' => $converter->toRomanNumerals($i),
                'hits' => random_int(100,1000)
            ]);

        }
    }
}
