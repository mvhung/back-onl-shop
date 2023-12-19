<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    public function index()
    {
        $orders = Orders::all();
        return response()->json($orders);
    }

    public function getOrderByCartId(Request $request): \Illuminate\Http\JsonResponse
    {
        $order =  DB::table('orders')->where('cart_id', $request->cart_id)->get();
        return response()->json($order);
    }
    // $request
    public function store(Request $request)
    {
        $order = new Orders;
        $order->name = $request->name;
        $order->create_date = $request->create_date;
        $order->address1 = $request->address1;
        $order->address2 = $request->address2;
        $order->city = $request->city;
        $order->cart_id = $request->cart_id;
        $order->save();
        return response()->json(['message' => "added order"], 201);
    }

    public function update(Request $request, $id)
    {
        $updateProduct = Orders::query()->findOrFail($id);
        $updateProduct->update([
            'name'=>$request->name,
            'create_date'=>$request->create_date,
            'address1'=>$request->address1,
            'address2'=>$request->address2,
            'city'=>$request->city,
            'cart_id'=>$request->cart_id,

        ]);

        return response()->json(['message' => 'Order successfully updated']);

    }
}
