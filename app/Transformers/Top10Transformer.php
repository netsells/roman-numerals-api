<?php

namespace App\Transformers;

use App\Contracts\ConversionStorage;
use League\Fractal\TransformerAbstract;

class Top10Transformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ConversionStorage $storage): array
    {
        return [
            'converted' => $storage->roman,
            'times'     => $storage->top
        ];
    }
}
