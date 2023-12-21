<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $product = Products::all();
        return response()->json($product);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductById(Request $request): \Illuminate\Http\JsonResponse
    {
        $product = Products::query()->findOrFail($request->productId);
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
        (new Products())->query()->create([
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
    public function update(Request $request)
    {
        $updateProduct = Products::query()->findOrFail($request->product['id']);
        $updateProduct->update([
            'title'=>$request->product['title'],
            'category'=>$request->product['category'],
            'price'=>$request->product['price'],
            'image_url'=>$request->product['image_url']
        ]);

        return response()->json(['message' => 'Product successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProductById(Request $request, $productId): \Illuminate\Http\JsonResponse
    {
        $deletedProduct = Products::query()->findOrFail($productId)->delete();
        return response()->json(['message' => 'Product successfully deleted']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByCategory(Request $request): \Illuminate\Http\JsonResponse
    {
        $product =  DB::table('products')->where('category', $request->category)->get();
        return response()->json($product);
    }
}
