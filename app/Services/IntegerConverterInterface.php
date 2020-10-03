<?php

namespace App\Services;

interface IntegerConverterInterface
{
    public function convertInteger(int $integer): string;
}
