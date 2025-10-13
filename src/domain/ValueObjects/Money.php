<?php

namespace Src\domain\ValueObjects;

final readonly class Money
{
    public function __construct(
        protected float $amountInMajor
    )
    {
    }

    public function toMajor(): float
    {
        return $this->amountInMajor;
    }

    public function toMinor(): int
    {
        return (int) round($this->amountInMajor * 100);
    }

    public static function fromMinor(int $amountInMinor): self
    {
        return new self($amountInMinor / 100);
    }

    public static function fromMajor(float $amountInMajor): self
    {
        return new self($amountInMajor);
    }
}
