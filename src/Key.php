<?php

namespace NooraniMm\EncoderAlgorithm;

use NooraniMm\EncoderAlgorithm\Exceptions\InvalidKeyException;

class Key
{
    protected int $code;
    protected string $key;
    protected array $validation;

    /**
     * @throws InvalidKeyException
     */
    public function __construct(string|int $key, array $validation = null)
    {
        if (is_string($key)) {
            if (strlen($key) === 0) {
                throw new InvalidKeyException("Key is not valid !");
            }
            $this->key = $key[0];
        }
        else {
            $this->key = chr($key);
        }

        $code = $this->code();

        if (! isset($validation)) {
            $chk1 = ($code / 2) + 64;
            $chk2 = ($code % 2) + 65;
            $this->validation = [chr($chk1), chr($chk2)];
        }
        else {
            $this->validation = $validation;
        }
    }

    public function code(): int
    {
        if (isset($this->code)) {
            return $this->code;
        }

        $key = strtoupper($this->key);
        $ord = ord($key);

        $this->code = $ord - 64;

        return $this->code;
    }

    public function character(): string
    {
        return $this->key;
    }

    public function validation(): array
    {
        return $this->validation;
    }

    /**
     * @throws InvalidKeyException
     */
    public static function generator(string $key, array $validation): Key
    {
        $chk1 = (ord($validation[0]) - 64) * 2;
        $chk2 = ord($validation[1]) - 65;
        $ord  = ord($key) - 64;

        if ($chk1 + $chk2 !== $ord) throw new InvalidKeyException("Key is not valid!");

        return new self($key, $validation);
    }
}