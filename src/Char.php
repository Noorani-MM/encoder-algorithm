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
}