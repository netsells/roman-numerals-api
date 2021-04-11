<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numeral extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes
     *
     * @var array $fillable 
     */
    protected $fillable = [
        'number',
        'numeral'
    ];

    /**
     * Conversions a numeral each numeral
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(NumeralConversion::class)->orderBy('created_at', 'DESC');
    }

    /**
     * Most recent conversions numeral conversions
     * 
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecent($query)
    {
        return $query->with('conversions')->orderBy('updated_at', 'desc');
    }

    /**
     * Grab the top results
     * 
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeTop($query)
    {
        return $query->withCount('conversions')->orderBy('conversions_count', 'DESC');
    }
}
