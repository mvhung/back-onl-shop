<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Orders;
use App\Models\PlacedOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    public function getPlacedOrders(Request $request){
        $placed_orders = DB::table('placed_orders')->where('order_id', $request->orderId)->get();
        return response()->json($placed_orders);
    }
    public function getAllPlacedOrders(){
        $placed_orders = PlacedOrders::all();
        return response()->json($placed_orders);
    }

    public function filterOrders(Request $request)
{
    // Handle null or undefined values
    $customer = $request->customer ?? '';
    $address = $request->address ?? '';
    $phoneNumber = $request->phoneNumber ?? '';

    // Add '%' around the values for LIKE comparison
    $customer = '%' . $request->customer . '%';
    $address = '%' . $request->address . '%';
    $phoneNumber = '%' . $request->phoneNumber . '%';

    // Handle date values
   
    $orders = Orders::where('name', 'like', $customer)
        ->where('address1', 'like', $address)
        ->where('city', 'like', $phoneNumber)
        ->get();

    
    return $orders;
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
