<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPriceRequest;
use App\Http\Resources\ProductPriceResource;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of prices for a specific product.
     */
    public function index(Product $product): AnonymousResourceCollection
    {
        $prices = $product->prices()->with('currency')->get();

        return ProductPriceResource::collection($prices);
    }

    /**
     * Store a newly created price for a product.
     */
    public function store(StoreProductPriceRequest $request, Product $product): JsonResponse
    {
        $productPrice = $product->prices()->create($request->validated());

        $productPrice->load('currency');

        return (new ProductPriceResource($productPrice))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified price from storage.
     */
    public function destroy(Product $product, ProductPrice $price): JsonResponse
    {
        $price->delete();

        return response()->json([
            'message' => 'Product price deleted successfully'
        ], 200);
    }
}
