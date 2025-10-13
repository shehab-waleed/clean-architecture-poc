<?php

namespace Src\domain\Models;

use Src\domain\ValueObjects\Money;

final readonly class OrderLine
{
    public function __construct(
        public ?int $id = null,
        public Product $product,
        public int $quantity,
        public Money $unitPrice
    ) {
    }

    public function totalAmount(): Money
    {
        return Money::fromMajor($this->unitPrice->toMajor() * $this->quantity);
    }
}
