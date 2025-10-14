<?php

namespace Src\api\Controllers;

use Illuminate\Routing\Controller;
use Src\api\Requests\StoreProductRequest;
use Src\application\Commands\CreateProduct\CreateProductCommand;
use Src\application\Commands\CreateProduct\CreateProductCommandHandler;
use Src\application\Queries\GetProduct\GetProductQuery;
use Src\application\Queries\GetProduct\GetProductQueryHandler;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    //TODO Introduce view models instead of depending on the domain models directly
    public function show(
        int $id,
        GetProductQueryHandler $getProductQueryHandler
    )
    {
        $response = $getProductQueryHandler->handle(
            new GetProductQuery($id)
        );

        return response()->json(
            [
                'id' => $response->product?->id,
                'name' => $response->product?->name,
                'description' => $response->product?->description,
                'price' => $response->product?->price->toMajor(),
            ],
            Response::HTTP_OK
        );
    }

    public function store(
        StoreProductRequest $request,
        CreateProductCommandHandler $createProductCommandHandler
    )
    {
        $response = $createProductCommandHandler->handle(
            new CreateProductCommand(
                $request->name,
                $request->price,
                $request->description
            )
        );

        return response()->json(
            [
                'id' => $response->product->id,
                'name' => $response->product->name,
                'description' => $response->product->description,
                'price' => $response->product->price->toMajor(),
            ],
            Response::HTTP_CREATED
        );
    }
}
