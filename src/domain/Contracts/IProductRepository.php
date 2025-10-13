<?php

namespace Src\domain\Contracts;

use Src\domain\Models\Product;

interface IProductRepository
{
    public function create(Product $product): Product;
    public function findById(int $id): ?Product;
}
