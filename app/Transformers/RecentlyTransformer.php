<?php

namespace App\Transformers;

use App\Contracts\ConversionStorage;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class RecentlyTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ConversionStorage $storage): array
    {
        return [
            'id'      => $storage->id,
            'integer' => $storage->arabic,
            'ago'     => Carbon::createFromFormat('Y-m-d H:i:s', $storage->created_at)->diffForHumans()
        ];
    }
}
