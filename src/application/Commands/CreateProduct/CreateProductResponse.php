<?php

namespace Src\application\Commands\CreateProduct;

use Src\domain\Models\Product;

final readonly class CreateProductResponse
{
    public function __construct(
        public Product $product
    ) {}
}
