<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NumeralConversionResource extends JsonResource
{
    /**
     * Transform the Numeral into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'numeral' => $this->numeral,
            'number' => (int)$this->number,
            'last_converted_at' => $this->updated_at->toDateTimeString(),
            'conversion_count' => $this->conversions->count()
        ];
    }
}
