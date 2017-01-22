<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class RomanTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(string $data): array
    {
        return [
            'response' => $data
        ];
    }
}
