<?php

namespace NooraniMm\EncoderAlgorithm;

class DecimalToHex
{
    const DIGITS = "0123456789ABCDEF";
    public static function DecimalToHex(int $number): string
    {
        $hex = "";
        do {
            $index = $number % 16;
            $hex .= self::DIGITS[$index];
            $number = floor($number / 16);
        } while ($number > 0);

        $hex = strrev($hex);

        return str_pad($hex, 4, "0", STR_PAD_LEFT);
    }
}