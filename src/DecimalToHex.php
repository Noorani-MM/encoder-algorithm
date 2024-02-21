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

    public static function HexToDecimal(string $hex): int {
        $result = 0;
        $length = strlen($hex);
        $hex = strtoupper($hex);

        foreach (str_split($hex) as $key => $value) {
            $index = $key+1;
            $number = array_search($value, str_split(self::DIGITS));
            $pow = $length - $index;
            $result += $number * (16**$pow);
        }

        return $result;
    }
}