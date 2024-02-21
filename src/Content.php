<?php

namespace NooraniMm\EncoderAlgorithm;

class Content
{
    private int $sum;
    public function __construct(protected $content) {   }

    public function length(): int
    {
        return strlen($this->content);
    }

    public function sum(): int
    {
        if (isset($this->sum)) return $this->sum;

        $this->sum = 0;

        foreach (str_split($this->content) as $char) {
            $ord = ord($char);
            $this->sum += $ord;
        }

        return $this->sum;
    }
}