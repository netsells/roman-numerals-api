<?php

namespace App\Http\Controllers ;

use App\Http\Controllers\Controller ;
use App\Http\Models\NumeralConversion as Database ;
use League\Fractal\Manager as Fractal ;
use League\Fractal\Resource\Collection as FractalCollection;

class TopConvertedController extends Controller
{
    public function __invoke($count)
    {
    /*
     * This encodes the response inside a JSON 'data' block. Good for SSE or something somewhere.
     *
        $fractal = new Fractal() ;

        $collection = new FractalCollection(Database::top($count), function($record)
        {
            return [
                'frequency' => $record['frequency'],
                'integer'   => $record['integer'],
                'numeral'   => $record['numeral']
            ] ;
        }) ;

        return $fractal->createData($collection)->toJson() ;
    */
        return json_encode(Database::top($count)) ;
    }
}
