<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\Products;
use App\Models\PlacedOrders;
use App\Http\Requests\StoreShoppingCartRequest;
use App\Http\Requests\UpdateShoppingCartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createShoppingCart(Request $request)
    {
        ShoppingCart::where('cart_id', $request->cart_id)->delete();
        $this->createDefaultShoppingcart($request->cart_id);

        return response()->json(['message' => 'created shopping cart']);
    }



    public function createDefaultShoppingcart($cartId)
    {
        $productIds = Products::all('id')->pluck('id');
        // $shoppingCartList = []; 

        foreach ($productIds as $id) {
            $defaultCart = new ShoppingCart();
            $defaultCart->cart_id = $cartId;
            $defaultCart->product_id = $id;
            $defaultCart->quantity = 0;
            // $shoppingCartList[] = $defaultCart;
            // ShoppingCart::insert($shoppingCartList);
            $defaultCart->save();
        }

        // return response()->json(['message'=>'created default shopping cart','status'=>201]);
    }

    public function updateShoppingCart(Request $request)
    {
        $cartId = $request->get('cart_id');
        $change = $request->get('change');
        $productId = $request->get('product_id');

        $cart = ShoppingCart::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->firstOrFail();

        $newQuantity = $cart->quantity + $change;
        $cart->quantity = $newQuantity;
        $cart->save();

        return $newQuantity;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShoppingCartRequest  $request
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShoppingCartRequest $request, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function deleteShoppingCart(Request $request)

    {
        $cartId = $request->cart_id;
        $orderId = $request->order_id;
        
        $shoppingCartList = DB::table('shopping_carts')->where('cart_id', $cartId)->get();

        if ($shoppingCartList->isEmpty()) {
            return $shoppingCartList;
        }


        foreach ($shoppingCartList as $item) {
            if ($item->quantity < 1) {
                continue;
            }

            $placed = new PlacedOrders();
            $placed->order_id = $orderId;
            $placed->product_id = $item->product_id;
            $placed->quantity = $item->quantity;
            $placed->save();
        }


        ShoppingCart::where('cart_id', $cartId)->delete();

        $this->createDefaultShoppingCart($cartId);

        return response()->json(['message'=>'asdhajksd']);
    }
}
