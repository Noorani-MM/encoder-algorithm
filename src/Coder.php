<?php

namespace NooraniMm\EncoderAlgorithm;

class Coder
{
    public static function encode(string $value): string
    {
        $result = "";
        $content = new Content($value);

        $hex = DecimalToHex::DecimalToHex($content->sum());
        $length = DecimalToHex::DecimalToHex($content->length());

        $keys = self::keys();
        $key_ords = [ord($keys[0]), ord($keys[1])];

        $checks = self::key_check($keys);

        foreach (str_split($value) as $index => $char) {
            $c_ord = ord($char);
            // Code with key1
            if ($index % 2 === 0) {
                $c_ord += ($key_ords[0] - 64);
            }
            // Code with key2
            else {
                $c_ord -= ($key_ords[1] - 64);
            }
            $result .= chr($c_ord);
        }

        return implode("", [chr($keys[0]), chr($keys[1]), $hex, $result, $length, $checks['key1'][0], $checks['key2'][0], $checks['key1'][1], $checks['key2'][1]]);
    }

    protected static function keys(): array
    {
        $key1 = rand(1, 26) + 64;
        $key2 = rand(1, 26) + 64;

        return [$key1, $key2];
    }

    protected static function key_check(array $keys): array
    {
        $code1 = $keys[0] - 64;
        $code2 = $keys[1] - 64;

        $chk11 = chr(($code1 / 2) + 64);
        $chk12 = chr(($code1 % 2) + 65);

        $chk21 = chr(($code2 / 2) + 64);
        $chk22 = chr(($code2 % 2) + 65);

        return ['key1' => [$chk11, $chk12], 'key2' => [$chk21, $chk22]];
    }
}