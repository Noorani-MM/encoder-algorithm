<?php

namespace NooraniMm\EncoderAlgorithm;

class CryptoHandler
{
    public static function Encrypt(string $content): string
    {
        $data = Char::char_array(str_split($content));

        $rev_binaries = array_map(function (Char $char) {
            return self::reverse_bite($char->binary());
        }, $data);

        $hexes = array_map(function (string $binary) {return self::binary_to_hex($binary); }, $rev_binaries);
        return implode('', $hexes);
    }

    public static function Decrypt(string $hex): string
    {
        $hexes = str_split($hex, 2);
        $binaries = array_map(function ($hex) {
            return self::hex_to_binary($hex);
        }, $hexes);

        $data = array_map(function ($binary) {
            return chr(base_convert(self::reverse_bite($binary), 2, 10));
        }, $binaries);

        return implode('', $data);
    }

    protected static function reverse_bite(string $binary): string
    {
        $result = '';
        foreach (str_split($binary) as $bite) {
            $result .= $bite === '0' ? '1' : '0';
        }
        return $result;
    }

    protected static function binary_to_hex(string $binary): string
    {
        return dechex(base_convert($binary, 2, 10));
    }

    protected static function hex_to_binary(string $hex): string
    {
        $binary = '';
        for ($i = 0; $i < strlen($hex); $i++) {
            $binary .= self::hex_digit_to_binary($hex[$i]);
        }
        return $binary;
    }

    protected static function hex_digit_to_binary(string $hex_digit): string
    {
        return str_pad(decbin(hexdec($hex_digit)),4,'0', STR_PAD_LEFT);
    }
}