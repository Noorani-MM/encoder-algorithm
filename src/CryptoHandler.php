<?php

namespace NooraniMm\EncoderAlgorithm;

class CryptoHandler
{
    public static function Encrypt(string $content): string
    {
        $char = new Char($content);
        $rev_binary = self::reverse_bite($char->binary());
        return self::binary_to_hex($rev_binary);
    }

    public static function Decrypt(string $hex): Char
    {
        $binary = self::hex_to_binary($hex);
        $rev_bite = self::reverse_bite($binary);
        return Char::char_by_binary($rev_bite);
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