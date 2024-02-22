<?php

namespace NooraniMm\EncoderAlgorithm;

use NooraniMm\EncoderAlgorithm\Exceptions\InvalidEncodeException;
use NooraniMm\EncoderAlgorithm\Exceptions\InvalidKeyException;

class Coder
{
    /**
     * @throws InvalidKeyException
     */
    public static function encode(string $value): string
    {
        $result = "";
        $content = new Content($value);
        $value = str_replace(' ', '♂', $value);

        $hex = DecimalToHex::DecimalToHex($content->sum());
        $length = DecimalToHex::DecimalToHex($content->length());

        $key1 = new Key(rand(1, 26) + 64);
        $key2 = new Key(rand(1, 26) + 64);

        foreach (str_split($value) as $index => $char) {
            $c_ord = ord($char);
            // Code with key1
            if ($index % 2 === 0) {
                $c_ord += ($key1->code());
            }
            // Code with key2
            else {
                $c_ord -= ($key2->code());
            }
            $result .= chr($c_ord);
        }

        return implode("", [$key1->character(), $key2->character(),
            $hex, $result, $length,
            $key1->validation()[0], $key2->validation()[0], $key1->validation()[1], $key2->validation()[1]]);
    }

    /**
     * @throws InvalidKeyException
     * @throws InvalidEncodeException
     */
    public static function decode(string $encode)
    {
        $length = strlen($encode);
        $key1 = Key::generator($encode[0], [$encode[$length - 4], $encode[$length - 2]]);
        $key2 = Key::generator($encode[1], [$encode[$length - 3], $encode[$length - 1]]);
        $encontent = self::get_encoded_content($encode);
        $en_result = self::get_encoded_result($encode);
        $en_length = self::get_encoded_length($encode);

        $result = '';
        foreach (str_split($encontent) as $index => $char) {
            $ord = ord($char);
            if ($index % 2 === 0) {
                $ord -= $key1->code();
            }
            else {
                $ord += $key2->code();
            }
            $result .= chr($ord);
        }

        $result = str_replace('♂', ' ', $result);
        $content = new Content($result);
        if (($content->sum() !== DecimalToHex::HexToDecimal($en_result)) || ($content->length() !== DecimalToHex::HexToDecimal($en_length))) {
            throw new InvalidEncodeException("This encode is invalid");
        }

        return $result;
    }

    protected static function get_encoded_content(string $encode): string
    {
        $length = strlen($encode);
        return substr($encode, 6, ($length - 14));
    }

    protected static function get_encoded_result(string $encode): string
    {
        return substr($encode, 2, 4);
    }

    protected static function get_encoded_length(string $encode): string
    {
        $length = strlen($encode);
        return substr($encode, $length - 8, 4);
    }
}