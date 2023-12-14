<?php

namespace App\Http\Controllers;

use App\Models\PlacedOrders;
use App\Http\Requests\StorePlacedOrdersRequest;
use App\Http\Requests\UpdatePlacedOrdersRequest;

class PlacedOrdersController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlacedOrdersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlacedOrdersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlacedOrders  $placedOrders
     * @return \Illuminate\Http\Response
     */
    public function show(PlacedOrders $placedOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlacedOrders  $placedOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacedOrders $placedOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlacedOrdersRequest  $request
     * @param  \App\Models\PlacedOrders  $placedOrders
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlacedOrdersRequest $request, PlacedOrders $placedOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlacedOrders  $placedOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacedOrders $placedOrders)
    {
        //
    }
}
