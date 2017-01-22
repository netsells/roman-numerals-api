<?php

namespace App\Contracts;

interface ConversionStorage
{
    /**
     * Save data.
     */
    public function persist(int $arabic, string $roman);

    /**
     * Lists the top 10 converted integers.
     */
    public function top10();

    /**
     * Lists all of the recently converted integers.
     */
    public function recently();

}
