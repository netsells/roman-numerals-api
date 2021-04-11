<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NumeralConversionResource;
use App\Models\Numeral;
use App\Services\IntegerConverterInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NumeralsController extends Controller
{
    /**
     * Return a Roman Numeral for a given number
     * 
     * @param Request $request
     *
     * @return NumeralResource $numeralResource
     */
    public function convert(Request $request): NumeralConversionResource
    {
        $validate = $request->validate([
            'number'  => [
                'required',
                'integer',
                'between:1,3999'
            ],
        ]);

        $conversion = app(IntegerConverterInterface::class)->convertInteger($request->input('number'));
        $numeral = Numeral::firstOrCreate([
            'number' => $request->input('number'),
            'numeral' => $conversion
        ]);

        // Just update updated_at to show a conversion has happened
        if (!$numeral->wasRecentlyCreated) {
            $numeral->touch();
        }
        $numeral->conversions()->create();

        return new NumeralConversionResource($numeral);
    }

    /**
     * Returns all conversions paginated
     * 
     * @return NumeralResource $numeralResource
     */
    public function index(): AnonymousResourceCollection
    {
        $numerals = Numeral::recent()->paginate();

        return NumeralConversionResource::collection($numerals);
    }


    /**
     * Returns the top 10 converted numerals
     * 
     * @return NumeralResource $numeralResource
     */
    public function top(): AnonymousResourceCollection
    {
        $numerals = Numeral::top()->get();

        return NumeralConversionResource::collection($numerals);
    }

}
