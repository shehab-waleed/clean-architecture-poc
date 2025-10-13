<?php

namespace Src\infrastructure\Mappers;

use App\Models\Product;
use Src\domain\ValueObjects\Money;

class ProductMapper
{
    public static function from(Product $product) : \Src\domain\Models\Product
    {
        return new \Src\domain\Models\Product(
            id: $product->getKey(),
            name: $product->name,
            description: $product->description,
            price: new Money($product->price)
        );
    }
}
