<?php

namespace NooraniMm\EncoderAlgorithm;

class Char
{
    public function __construct(protected string $char)
    {
    }

    public function binary(): string
    {
        return str_pad(base_convert(ord($this->char), 10, 2),8, '0', STR_PAD_LEFT);
    }

    public function char(): string
    {
        return $this->char;
    }

    public static function char_array(array $chars): array
    {
        $data= [];
        foreach ($chars as $char) {
            $data[] = new self($char);
        }
        return $data;
    }
}