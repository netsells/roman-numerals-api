<?php

namespace App\Traits;

use App\Models\Conversion;

trait SaveConversion
{
    protected function saveConversion($roman)
    {
        return Conversion::create([
            'number' => request('number'),
            'roman_numeral' => $roman,
        ]);
    }
}
