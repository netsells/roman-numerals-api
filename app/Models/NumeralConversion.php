<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumeralConversion extends Model
{
    use HasFactory;

    /**
     * The numeral attached to the conversion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function numeral(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Numeral::class);
    }
}
