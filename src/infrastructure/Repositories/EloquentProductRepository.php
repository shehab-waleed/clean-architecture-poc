<?php

namespace Src\infrastructure\Repositories;

use Src\domain\Contracts\IProductRepository;
use Src\domain\Models\Product;
use Src\infrastructure\Mappers\ProductMapper;

class EloquentProductRepository implements IProductRepository
{
    public function create(Product $product): Product
    {
        $productModel = \App\Models\Product::create([
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price->toMinor(),
        ]);

        return ProductMapper::from($productModel);
    }

    public function findById(int $id): ?Product
    {
        $productModel = \App\Models\Product::find($id);

        if (!$productModel) {
            return null;
        }

        return ProductMapper::from($productModel);
    }
}
