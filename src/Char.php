<?php

namespace NooraniMm\EncoderAlgorithm;

use NooraniMm\EncoderAlgorithm\Exceptions\InvalidCharException;

class Char
{
    public function __construct(protected string $char)
    {
    }

    public function ascii(): int
    {
        return ord($this->char);
    }

    public function binary(): string
    {
        return Binary::int_to_binary($this->ascii());
    }
}