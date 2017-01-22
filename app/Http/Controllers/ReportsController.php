<?php

namespace App\Http\Controllers;

use App\Contracts\ConversionStorage;
use App\Transformers\RecentlyTransformer;
use App\Transformers\Top10Transformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;
use Spatie\Fractal\Fractal;

class ReportsController extends Controller
{
    /**
     * @param ConversionStorage $storage
     */
    public function top10(ConversionStorage $storage)
    {
        return fractal($storage->top10(), new Top10Transformer)->respond(200, [
            'X-TOP10' => 1
        ]);
    }

    /**
     * @param ConversionStorage $storage
     */
    public function recent(ConversionStorage $storage, int $perPage = 3)
    {
        $paginator = $storage->recently($perPage);
        $data      = $paginator->getCollection();

        return Fractal::create()
            ->collection($data, new RecentlyTransformer)
            ->serializeWith(new JsonApiSerializer)
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->respond();
    }
}
