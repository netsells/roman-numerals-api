<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversion;
use App\Traits\SaveConversion;
use App\Helpers\ConversionHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConvertRequest;
use App\Http\Resources\ConversionResource;

class ConversionController extends Controller
{
    use SaveConversion;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConversionResource::collection(Conversion::latest()->get());
    }

    /**
     * Display a top 10 integer.
     *
     * @return \Illuminate\Http\Response
     */
    public function top()
    {
        return ConversionResource::collection(Conversion::select('number', DB::raw('COUNT(number) as count'))
            ->groupBy('number')
            ->orderBy('count', 'DESC')
            ->take(10)
            ->get());
    }

    /**
     * Store converted integers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(ConvertRequest $request): JsonResponse
    {
        $roman = (new ConversionHelper())->convert($request->number);
        $response = $this->saveConversion($roman);
        return response()->json([
            'data'    => new ConversionResource($response),
            'message' => 'Conversion successfully created.',
        ]);
    }
}
