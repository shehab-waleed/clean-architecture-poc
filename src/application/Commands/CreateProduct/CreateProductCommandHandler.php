<?php

namespace Src\application\Commands\CreateProduct;

use Src\domain\Contracts\IProductRepository;
use Src\domain\Models\Product;
use Src\domain\ValueObjects\Money;

final readonly class CreateProductCommandHandler
{
    public function __construct(
        protected IProductRepository $productRepository
    )
    {
    }

    public function handle(CreateProductCommand $command): CreateProductResponse
    {
        //TODO Handle validation by introducting value objects
        $product = $this->productRepository->create(
            new Product(
                name: $command->name,
                description: $command->description,
                price: Money::fromMajor($command->price)
            )
        );

        return new CreateProductResponse($product);
    }
}
