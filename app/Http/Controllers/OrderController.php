<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
    //    dd('asdfdf');
        return response()->json($orders);
    }

    // $request
    public function store(Request $request)
    {
        // dd('asd');
        $order = new Orders;
        // $order->name = $request->name;
        // $order->order_id = $request->order_id;
        // $order->create_date = $request->create_date;
        // $order->address1 = $request->address1;
        $order->name = 'sfdsgd';
        $order->order_id = 'afdsfdf';
        $order->create_date = '1900/12/12';
        $order->address1 = '32245';
        $order->address2 = '23124234';
        $order->city = '23224234';
        $order->cart_id = 'ndndsk';
        $order->save();
        return response()->json(['message' => "added order"], 201);

    }
}
