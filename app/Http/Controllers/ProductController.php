<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $product = Product::all();
        return response()->json($product);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductById(Request $request): \Illuminate\Http\JsonResponse
    {
        $product = Product::query()->findOrFail($request->id);
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request): \Illuminate\Http\JsonResponse
    {
        (new Product())->query()->create([
            'title'=>$request->title,
            'category'=>$request->category,
            'price'=>$request->price,
            'image_url'=>$request->image_url
        ]);

        return response()->json(['message' => 'Product successfully created']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $updateProduct = Product::query()->findOrFail($id);
        $updateProduct->update([
            'title'=>$request->title,
            'category'=>$request->category,
            'price'=>$request->price,
            'image_url'=>$request->image_url
        ]);

        return response()->json(['message' => 'Product successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProductById(Request $request): \Illuminate\Http\JsonResponse
    {
        $deletedProduct = Product::query()->findOrFail($request->id)->delete();
        return response()->json(['message' => 'Product successfully deleted']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByCategory(Request $request): \Illuminate\Http\JsonResponse
    {
        $product = Product::query()->findOrFail($request->id);
        return response()->json($product);
    }
}
