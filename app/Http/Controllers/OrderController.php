<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Orders;
use App\Models\PlacedOrders;
use App\Models\Products;
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
        $listOrder = [];
        $placed_orders = DB::table('placed_orders')->where('order_id', $request->orderId)->get();
        foreach ($placed_orders as $placed_order){
            $product = Products::query()->findOrFail($placed_order->product_id);
            $res = [
                'orderId'=>$request->orderId,
                'product'=>$product,
                'quantity'=>$placed_order->quantity
            ];
            $listOrder[]=$res;
        }

        return response()->json($listOrder);
    }
    public function getAllPlacedOrders(){
        $orders = Orders::all();
        $res = [];
        foreach($orders as $order) {
            $item = [
                "orderDate"=>$order->create_date,
                "cartId"=>$order->cart_id,
                "shipping"=>["name"=>$order->name,"addressLine1"=>$order->address1,"addressLine2"=>$order->address2,
                    "city"=>$order->city
                ],
                "orderId"=>$order->order_id
            ];
        $res[] = $item;
    }
        return response()->json($res);
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
        $order->name = $request->shipping['name'];
        $order->create_date = Carbon::now();
        $order->address1 = $request->shipping['addressLine1'];
        $order->address2 = $request->shipping['addressLine2'];
        $order->city = $request->shipping['city'];
        $order->cart_id = $request->cartId;
        $order->save();
        return $order;
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
