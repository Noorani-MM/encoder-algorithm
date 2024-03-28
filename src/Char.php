<?php

namespace NooraniMm\EncoderAlgorithm;

use NooraniMm\EncoderAlgorithm\Exceptions\InvalidCharException;

class Char
{
    private array $bytes;
    public function __construct(protected string $char)
    {
        $this->char = mb_convert_encoding($this->char, 'UTF-8', 'UTF-8');
        $this->bytes = unpack('C*', $this->char);
    }

    public function binary(): string
    {
        $binary = '';
        foreach ($this->bytes as $byte) {
            $binary .= str_pad(decbin($byte), 8, '0', STR_PAD_LEFT);
        }
        return $binary;
    }

    public function bytes(): false|array
    {
        return $this->bytes;
    }

    public function char(): string
    {
        return $this->char;
    }

    public static function char_by_binary(string $binary): Char
    {
        $segments = str_split($binary, 8);
        $chars = '';
        foreach ($segments as $segment) {
            $chars .= pack('H*', base_convert($segment, 2, 16));
        }
        return new self($chars);
    }
}