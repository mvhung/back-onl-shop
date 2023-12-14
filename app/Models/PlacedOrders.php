<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacedOrders extends Model
{
    use HasFactory;
    protected $table ='placed_orders';
    protected $fillable = ['id','order_id','product_id','quantity'];
}
