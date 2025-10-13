<?php

namespace Src\application\Queries\GetProduct;

use Src\domain\Models\Product;

final readonly class GetProductResponse
{
    public function __construct(
        public ?Product $product = null
    ) {}
}
