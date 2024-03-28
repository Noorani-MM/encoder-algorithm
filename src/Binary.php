<?php

namespace NooraniMm\EncoderAlgorithm;

class Binary
{
    public static function int_to_binary(int $number): string
    {
        $binary = "";
        do {
            $bit = $number % 2;
            $binary .= "{$bit}";
            $number /= 2;
        } while ($number > 1);
        $binary .= floor($number / 2);

        return strrev($binary);
    }
}