<?php

namespace Src\domain\ValueObjects;

final readonly class Money
{
    public function __construct(
        protected int $amountInMinor
    )
    {
    }

    public function toMajor(): float
    {
        return $this->amountInMinor / 100;
    }

    public function toMinor(): int
    {
        return $this->amountInMinor;
    }

    public static function fromMinor(int $amountInMinor): self
    {
        return new self($amountInMinor);
    }

    public static function fromMajor(float $amountInMajor): self
    {
        return new self($amountInMajor * 100);
    }
}
