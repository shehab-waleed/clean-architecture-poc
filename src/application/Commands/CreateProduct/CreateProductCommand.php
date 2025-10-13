<?php

namespace Src\application\Commands\CreateProduct;

final readonly class CreateProductCommand
{
    public function __construct(
        public string $name,
        public float $price,
        public string $description
    ){}
}
