<?php

namespace Src\domain\Models;

use Illuminate\Support\Collection;
use Src\domain\Enums\OrderStatus;
use Src\domain\ValueObjects\Money;

/**
 * @property-read Collection<int, OrderLine> $lines
 */
final readonly class Order
{
    public function __construct(
        public ?int         $id = null,
        public User        $user,
        public Money       $amount,
        public OrderStatus $status,
        public Collection $lines
    ) {
    }
}
