<?php

namespace Src\application\Queries\GetProduct;

use Src\domain\Contracts\IProductRepository;

final readonly class GetProductQueryHandler
{
    public function __construct(
        protected IProductRepository $productRepository
    )
    {
    }

    public function handle(GetProductQuery $command) : GetProductResponse
    {
        return new GetProductResponse(
            $this->productRepository->findById(
                $command->productId
            )
        );
    }
}
