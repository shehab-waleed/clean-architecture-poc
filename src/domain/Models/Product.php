<?php

namespace Src\domain\Models;

use Src\domain\ValueObjects\Money;

final readonly class Product
{
    public function __construct(
        public string $name,
        public string $description,
        public Money $price,
        public ?int $id = null,
    ) {
    }
}
